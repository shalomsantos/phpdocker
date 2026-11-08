<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use App\Controllers\Controller;
use App\Services\UserService;
use \App\Services\JwtService;
use PDO;
use PDOException;

class LoginController extends Controller
{
    private JwtService $jwtService;
    private UserService $userService;

    function __construct(JwtService $jwtService, UserService $userService)
    { 
        $this->jwtService = $jwtService;
        $this->userService = $userService;
    }

    function index(): void
    {
        if (isset($_COOKIE['auth_token'])) {
            $isValid = $this->jwtService->validateToken($_COOKIE['auth_token']);

            if ($isValid) {
                header("Location: /home");
                exit;
            }
        }

        $this->view("pages/auth/login", ['usuario_table' => $this->userService->getTable()]);
    }

    function login(): void
    {
        try {
            $email    = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $user     = $this->userService->findByEmail($email);

            if ($user && isset($user['senha'])) {

                $senhaValida = password_verify($password, $user['senha']) || $password === $user['senha'];

                if ($senhaValida) {
                    $token = $this->jwtService->generateToken(['id' => $user['id'], 'email' => $user['email']]);

                    setcookie('auth_token', $token, [
                        'expires' => time() + 3600,
                        'path' => '/',
                        'httponly' => true,
                        'samesite' => 'Lax',
                    ]);

                    Helpers::jsonResponse(200, [
                        'success' => true, 
                        'redirect' => '/home'
                    ]);
                }
            }

            Helpers::jsonResponse(401, ['success' => false, 'message' => 'E-mail ou senha incorretos.']);
        } catch (\Throwable $e) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => 'Erro interno',
                'details' => $e->getMessage()
            ]);
        }
    }

    function auth(): void
    {
        session_start();

        $pdo      = Database::getConnection();
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => 'Preencha todos os campos!'
            ]);
        }
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user['senha'] === $password) {
                    $_SESSION['user'] = $user;
                    Helpers::jsonResponse(200, [
                        'success' => true,
                        'redirect' => '/home'
                    ]);
                } else {
                    Helpers::jsonResponse(500, [
                        'success' => false,
                        'message' => 'Senha incorreta!'
                    ]);
                }
            } else {
                Helpers::jsonResponse(500, [
                    'success' => false,
                    'message' => 'Usuário não encontrado!'
                ]);
            }
        } catch (PDOException $e) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => 'Erro no servidor',
                'details' => $e->getMessage()
            ]);
        }
    }

    function logout(): void
    {
        try {
            setcookie('auth_token', '', time() - 3600, '/');
            header("Location: /");
            exit;
        } catch (\Throwable $e) {
            Helpers::jsonResponse(500, [
                'success'  => false,
                'message'  => 'Erro ao tentar deslogar: ' . $e->getMessage(),
                'redirect' => '/'
            ]);
        }
    }
}
