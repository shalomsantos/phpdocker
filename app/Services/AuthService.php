<?php

namespace App\Services;

use App\Helpers\Helpers;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private $key;
    private $algo;

    public function __construct()
    {
        $this->key = $_ENV['JWT_SECRET'] ?? null;
        $this->algo = $_ENV['JWT_ALLOWED_ALGO'] ?? 'HS256';
    }

    public function generateToken(array $userData)
    {
        $payload = [
            'iss' => 'seu-projeto-docker',  // Emissor
            'iat' => time(),                // Gerado em
            'exp' => time() + (60 * 60),    // Expira em 1 hora
            'data' => $userData             // Dados do usuário
        ];

        return JWT::encode($payload, $this->key, $this->algo);
    }

    public function validateToken($token)
    {
        try {
            return JWT::decode($token, new Key($this->key, $this->algo));
        } catch (\Exception $e) {
            return Helpers::jsonResponse(401, [
                'success' => false,
                'message' => 'Token inválido ou expirado.',
                'details' => $e->getMessage()
            ]);
        }
    }
}
