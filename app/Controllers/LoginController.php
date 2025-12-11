<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use PDO;
use PDOException;

class LoginController
{
    public function index()
    {
        require dirname(__DIR__, 2).'/views/auth/login.php';
    }

    public function auth()
    {
        session_start();

        $pdo = Database::getConnection();

        $email = trim($_POST['email'] ?? '');
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
                        'message' => 'Login bem sucedido!',
                        'redirect' => '/CadUsuarioPhp/app/Views/home/home.php'
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

    public function logout()
    {
        try {
            session_start();
            session_destroy();
            
            Helpers::jsonResponse(200, [
                'success' => true,
                'message' => 'Logout realizado com sucesso!',
                'redirect' => '/CadUsuarioPhp/app/Views/auth/login.php'
            ]);
        } catch (\Throwable $e) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => 'Erro ao tentar deslogar: ' . $e->getMessage(),
                'redirect' => '/CadUsuarioPhp/app/Views/auth/login.php'
            ]);
        }
    }
}