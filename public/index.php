<?php

use App\Helpers\Helpers;

require dirname(__DIR__, 1) . "/vendor/autoload.php";
require dirname(__DIR__, 1) . "/app/Config/bootstrap.php";
require dirname(__DIR__, 1) . "/routes/route.php";

try {
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $request = $_SERVER["REQUEST_METHOD"];

    if(!isset($routes[$request])){
        throw new Exception("O método HTTP {$request} não é suportado.");
    }

    if(!array_key_exists($uri, $routes[$request])){
        throw new Exception("A rota '{$uri}' não foi encontrada para o método {$request}.");
    }

    $controller = $routes[$request][$uri];
    $controller();
} catch (\Throwable $e) {
    Helpers::jsonResponse(500, [
        'success' => false,
        'message' => 'Erro no servidor',
        'details' => $e->getMessage()
    ]);
}