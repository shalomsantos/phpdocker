<?php

namespace App\Helpers;

class Helpers
{
    public static function jsonResponse(int $statusCode = 200, array $data = []): void
    {
        // Define o código HTTP
        http_response_code($statusCode);

        // Define o header de resposta
        header('Content-Type: application/json; charset=utf-8');

        // Garante saída limpa
        ob_clean();

        // Imprime o JSON formatado e encerra a execução
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
