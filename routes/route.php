<?php

function load(string $controller, string $action)
{
  try {
    $controllerNamespace = "App\\Controllers\\{$controller}";
  
    if(!class_exists($controllerNamespace)){
      throw new Exception("O controller {$controller} não existe.");
    }
    $controllerInstance = new $controllerNamespace();
  
    if(!method_exists($controllerInstance, $action)){
      throw new Exception("O método {$action} não existe no controller {$controller}");
    }
    $controllerInstance->$action((object) $_REQUEST);
  } catch (\Throwable $e) {
    echo $e->getMessage();
  }
}

$routes = [
  "GET" => [
    "/"           => fn() => load("LoginController", "index"),
    "/home"       => fn() => load("HomeController", "index"),
    "/logout"     => fn() => load("LoginController", "logout")
  ],
  "POST" => [
    "/login" => fn() => load("LoginController", "auth")
  ],
];



