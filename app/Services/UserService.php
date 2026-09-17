<?
namespace App\Services;

class UserService {
    
    function all()
    {
        $pdoInstance = Database::getConnection();
        
        $sql = $pdoInstance->prepare('SELECT * FROM usuario');
        $sql->execute();
        $fechUsuarios = $sql->fetchAll();
    }
}