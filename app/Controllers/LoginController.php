<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use App\Controllers\Controller;
use PDO;
use PDOException;

class LoginController
{
    public function index()
    {
        return Controller::view("auth/login");
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

                    return Controller::view("home/home");
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
            
            Controller::view("auth/login");
        } catch (\Throwable $e) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => 'Erro ao tentar deslogar: ' . $e->getMessage(),
                'redirect' => '/'
            ]);
        }
    }
}