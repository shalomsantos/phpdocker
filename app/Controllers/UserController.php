<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use PDO;
use PDOException;

class UserController
{
    public function index()
    {
        $pdoInstance = Database::getConnection();
        
        $sql = $pdoInstance->prepare('SELECT * FROM usuario');
        $sql->execute();
        $fechUsuarios = $sql->fetchAll();

        Helpers::jsonResponse(200, [
            'success' => true,
            'data' => $fechUsuarios,
        ]);
    }

    public function show($id)
    {
        $pdoInstance = Database::getConnection();

        $id = isset($_POST['id']) ?? null;

        if($id){
            try {
                $stmt = $pdoInstance->prepare('SELECT * FROM usuario WHERE id = :id');
                $stmt->execute([':id' => $id]);

                if (($stmt) and ($stmt->rowCount() != 0)) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                Helpers::jsonResponse(200, [
                    'success' => true,
                    'data' => $user,
                ]);
            } catch (\Throwable $e) {
                Helpers::jsonResponse(500, [
                    'success' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        }else{
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => "ID do usuário não informado!",
            ]);
        }

    }

    public function store()
    {
        $pdoInstance = Database::getConnection();

        $name     = $_POST['name']     ?? null;
        $email    = $_POST['email']    ?? null;
        $tel      = $_POST['tel']      ?? null;
        $password = $_POST['password'] ?? null;
        
        $isValidated = !empty($name) && !empty($email) && !empty($password);

        if ($isValidated) {
            try {
                $stmt = $pdoInstance->prepare('INSERT INTO usuario(nome, email, telefone, senha) VALUES(:nome, :email, :tel, :password)');
                $stmt->execute(array(
                    ':nome' => $name,
                    ':email' => $email,
                    ':tel' => $tel,
                    ':password' => $password
                ));
                Helpers::jsonResponse(200, [
                    'success' => true,
                    'message' => "Usuário cadastrado com sucesso!"
                ]);
            } catch (PDOException $e) {
                Helpers::jsonResponse(500, [
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => "dados insuficientes para realizar cadastro!"
            ]);
        }
        
    }
    public function destroy($id)
    {
        if (!isset($_POST['id'])) {
            Helpers::jsonResponse(400, [
                'success' => false,
                'message' => "ID do usuário não informado!"
            ]);
        }

        try {
            $id = $_POST['id'];
            $pdoInstance = Database::getConnection();
    
            $stmt = $pdoInstance->execute("DELETE FROM usuario WHERE id = :id");
            $stmt->execute([
                ':id' => $id
            ]);
        } catch (\Throwable $e) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
