<?php

use \App\Services\JwtService;
use App\Controllers\LoginController;
use App\Controllers\UserController;
use App\Models\Usuario;
use App\Services\UserService;

function load(string $controller, string $action)
{
    try {
        $controllerNamespace = "App\\Controllers\\{$controller}";

        if (!class_exists($controllerNamespace)) throw new Exception("O controller {$controller} não existe.");
        // Apos garantia que CONTROLLER, intancie o controller;
        $controllerInstance = match ($controllerNamespace) {
            UserController::class  => new UserController(new UserService(new Usuario())),
            LoginController::class => new LoginController(new JwtService(), new UserService(new Usuario())),
            default => new $controllerNamespace(),
        };

        if (!method_exists($controllerInstance, $action)) throw new Exception("O método {$action} não existe no controller {$controller}");
        // Apos garantia que a ACTION/FUNCTION existe, chame a função passando $_REQUEST;
        $controllerInstance->$action((object) $_REQUEST);
    } catch (\Throwable $e) {
        throw new Exception($e->getMessage());
    }
}

$routes = [
    "GET" => [
        "/"                 => fn() => load("LoginController", "index"),
        "/teste"            => fn() => load("LoginController", "teste"),
        "/home"             => fn() => load("HomeController", "index"),
        "/abstract-factory" => fn() => load("LoginController", "validationExam"),
        "/logout"           => fn() => load("LoginController", "logout"),
        "/users"            => fn() => load("UserController", "index"),
        "/news"              => fn() => load("NewsController", "index"),
        "/news/create"       => fn() => load("NewsController", "create"),
        "/news/show"         => fn() => load("NewsController", "show"),
    ],
    "POST" => [
        "/news/store" => fn() => load("NewsController", "store"),
        "/login"      => fn() => load("LoginController", "login"),
        "/user"       => fn() => load("UserController", "store"),
    ],
];
