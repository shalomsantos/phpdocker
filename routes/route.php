<?php

use App\Controllers\UserController;
use App\Controllers\LoginController;
use App\Services\UserService;
use \App\Services\JwtService;

function load(string $controller, string $action)
{
  try {
    $controllerNamespace = "App\\Controllers\\{$controller}";

    if(!class_exists($controllerNamespace)) throw new Exception("O controller {$controller} não existe.");
    // Apos garantia que CONTROLLER, intancie o controller;
    $controllerInstance = match ($controllerNamespace) {
      UserController::class  => new UserController(new UserService()),
      LoginController::class => new LoginController(new JwtService(), new UserService()),
      default => new $controllerNamespace(),
    };
  
    if(!method_exists($controllerInstance, $action)) throw new Exception("O método {$action} não existe no controller {$controller}");
    // Apos garantia que a ACTION/FUNCTION existe, chame a função passando $_REQUEST;
    $controllerInstance->$action((object) $_REQUEST);
  
  } catch (\Throwable $e) {
    throw new Exception($e->getMessage());
  }
}

$routes = [
  "GET" => [
    "/"          => fn() => load("LoginController", "index"),
    "/home"      => fn() => load("HomeController", "index"),
    "/logout"    => fn() => load("LoginController", "logout"),
    "/users/all" => fn() => load("LoginController", "allUsers")
  ],
  "POST" => [
    "/login"     => fn() => load("LoginController", "login"),
    "/user"      => fn() => load("UserController", "store")
  ],
];