<?php
define('BASE_URL', '/CadUsuarioPhp');

session_start();
session_destroy();
header('Location: '. BASE_URL.'/app/Views/auth/login.php');
?>