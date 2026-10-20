<?php

use League\Plates\Engine;

require dirname(__DIR__, 1)."/vendor/autoload.php";
require dirname(__DIR__, 1)."/app/Config/bootstrap.php";
require dirname(__DIR__, 1)."/routes/route.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$allowedMethods = [];

foreach ($routes as $routeMethod => $methodRoutes) {
    if (array_key_exists($uri, $methodRoutes)) {
        $allowedMethods[] = $routeMethod;
    }
}

$statusCode = 200;
$error = null;

if ($allowedMethods === []) {
    $statusCode = 404;
    $error = [
        'title' => 'Página não encontrada',
        'message' => 'A rota solicitada não existe.',
        'details' => $uri,
    ];
} elseif (!in_array($method, $allowedMethods, true)) {
    $statusCode = 405;
    sort($allowedMethods);
    header('Allow: ' . implode(', ', $allowedMethods));
    $error = [
        'title' => 'Método não permitido',
        'message' => "O método {$method} não é permitido para esta rota.",
        'details' => 'Métodos aceitos: ' . implode(', ', $allowedMethods),
    ];
} else {
    try {
        $routes[$method][$uri]();
    } catch (\Throwable $e) {
        error_log((string) $e);
        $statusCode = 500;
        $error = [
            'title' => 'Erro interno',
            'message' => 'Ocorreu um erro ao processar sua solicitação.',
            'details' => null,
        ];
    }
}

if ($error !== null) {
    http_response_code($statusCode);
    $templates = new Engine(dirname(__DIR__) . '/views');
    echo $templates->render('pages/errors/error', [
        'statusCode' => $statusCode,
        ...$error,
    ]);
}
