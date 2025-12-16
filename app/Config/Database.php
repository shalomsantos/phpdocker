<?php
namespace App\Config;

use PDO;
use PDOException;

//classe conexão.
class Database {
    private static $pdoInstance = null;

    //função q retorna o objeto de conexão com banco.
    public static function getConnection(){
        $dbhost = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        if (!$dbhost || !$dbname || !$user || !$password) {
            throw new \Exception("Erro de Configuração: Credenciais do banco de dados ausentes no ambiente.");
        }
        
        if (empty(self::$pdoInstance)) {
            try {
                self::$pdoInstance = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $user, $password);
                self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                header('Content-Type: application/json');
                return json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao conectar: ' . $e->getMessage()
                ]);
                exit;
            }
        }
        return self::$pdoInstance;
    }
}
?>