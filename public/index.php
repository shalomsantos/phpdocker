<?php
declare(strict_types=1);

use App\Exceptions\HttpException;
use App\Http\ErrorHandler;
use League\Plates\Engine;

require dirname(__DIR__) . '/vendor/autoload.php';

ErrorHandler::register((new Engine(dirname(__DIR__) . '/views')));

require dirname(__DIR__) . '/app/Config/bootstrap.php';
require dirname(__DIR__) . '/routes/route.php';

$method = $_SERVER['REQUEST_METHOD'];
$path   = rtrim((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';

// rota encontrada: executa e termina
if (isset($routes[$method][$path])) { $routes[$method][$path](); return; }

// a rota existe, mas em outro método? então é 405, não 404
$allowed = [];
foreach ($routes as $m => $lista)
    if (isset($lista[$path])) { $allowed[] = $m; }

if ($allowed) {
    header('Allow: ' . implode(', ', $allowed));
    throw new HttpException(405, 'Método não permitido', "O método {$method} não é aceito em '{$path}'.");
}

throw new HttpException(404, 'Página não encontrada', "A rota '{$path}' não foi encontrada para o método {$method}.");