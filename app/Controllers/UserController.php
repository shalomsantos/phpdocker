<?php

namespace App\Controllers;

use App\Config\Database;
use App\Helpers\Helpers;
use App\Services\UserService;
use PDOException;

class UserController extends AuthorizedController
{
    private UserService $userService;

    function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    public function index()
    {
        Helpers::jsonResponse(200, [
            'success' => true,
            'data' => $this->userService->all(),
        ]);
    }

    public function show(string $id): void
    {
        $id = isset($_POST['id']) ?? null;

        if (empty($id)) {
            Helpers::jsonResponse(500, [
                'success' => false,
                'message' => "ID do usuário não informado!",
            ]);
        }
        try {
            $user = $this->userService->find($id);

            if ($user <= 0) {
                Helpers::jsonResponse(404, [
                    'success' => false,
                    'message' => "Usuário não encontrado",
                ]);
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
    }

    public function store()
    {
        $pdoInstance = Database::getConnection();

        $name        = $_POST['nome']        ?? null;
        $email       = $_POST['email']       ?? null;
        $tel         = $_POST['telefone']    ?? null;
        $password    = $_POST['senha']       ?? null;
        $position_id = $_POST['position_id'] ?? null;

        $isValidated = !empty($name) && !empty($email) && !empty($password);

        if ($isValidated) {
            try {
                $sql = 'INSERT INTO usuario(nome, email, telefone, senha, position_id) VALUES(?, ?, ?, ?, ?)';

                $pdoInstance->prepare($sql)->execute([$name, $email, $tel, $password, $position_id]);

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

    public function destroy(string $id)
    {
        if (!isset($_POST['id'])) {
            Helpers::jsonResponse(400, [
                'success' => false,
                'message' => "ID do usuário não informado!"
            ]);
        }

        try {
            $id          = $_POST['id'];
            $pdoInstance = Database::getConnection();
            $stmt        = $pdoInstance->execute("DELETE FROM usuario WHERE id = :id");
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
