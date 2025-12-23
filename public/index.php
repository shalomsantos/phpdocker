<?php 
require dirname(__DIR__, 1) . "/vendor/autoload.php";
require dirname(__DIR__, 1) . "/app/Config/bootstrap.php";
require dirname(__DIR__, 1) . "/routes/route.php";

try {
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
    $request = $_SERVER["REQUEST_METHOD"];
    
    if(!isset($routes[$request])){
        throw new Exception("A rota {$routes[$request]} não existe.");
    }
    if(!array_key_exists($uri, $routes[$request])){
        throw new Exception("A rota {$routes[$request]} não existe");
    }

    $controller = $routes[$request][$uri];
    $controller();
} catch (\Throwable $e) {
    echo $e->getMessage();
}