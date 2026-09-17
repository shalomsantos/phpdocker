<?php

namespace App\Services;

use App\Helpers\Helpers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private $key;
    private $algo;

    function __construct()
    {
        $this->key = $_ENV['JWT_SECRET'] ?? null;
        $this->algo = $_ENV['JWT_ALLOWED_ALGO'] ?? 'HS256';
    }

    function generateToken(array $userData)
    {
        $payload = [
            'iss' => 'seu-projeto-docker',  // Emissor
            'iat' => time(),                // Gerado em
            'exp' => time() + (60 * 60),    // Expira em 1 hora
            'data' => $userData             // Dados do usuário
        ];

        return JWT::encode($payload, $this->key, $this->algo);
    }

    function validateToken($token)
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
