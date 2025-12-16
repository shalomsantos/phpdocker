<?php 
require_once dirname(__DIR__, 1) . '/vendor/autoload.php';
require_once dirname(__DIR__, 1) . '/app/Config/bootstrap.php';

use App\Controllers\LoginController;
use App\Controllers\UserController;

$controllerName = $_POST['controller'] ?? 'login';
$action         = $_POST['action']     ?? 'index';

switch (strtolower($controllerName)) {
    case 'login':
        $controller = new LoginController();
        break;
    case 'user':
        $controller = new UserController();
        break;
    // outras controllers...
    default:
        header('Content-type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Controller inválido']);
        exit;
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    header('Content-type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Action inválida']);
}