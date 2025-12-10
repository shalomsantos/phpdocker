<?php
require __DIR__ . '/../vendor/autoload.php';

echo "<h1>Projeto Shalom Online!</h1>";

// Teste de Conexão com Redis (Usando o nome do serviço 'redis')
try {
    $redis = new Redis();
    $redis->connect('redis', 6379);
    $redis->set('test_key', 'Conexão Redis OK!');
    $redis_status = $redis->get('test_key');
    echo "<p><strong>Status do Redis:</strong> $redis_status</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>Erro Redis:</strong> Não foi possível conectar ao serviço 'redis'.</p>";
}

// Teste de Versão do PHP
echo "<p><strong>Versão do PHP:</strong> " . phpversion() . "</p>";

// Exemplo de uso do Autoload
// $controller = new App\Controllers\HomeController();
// $controller->index();
?>