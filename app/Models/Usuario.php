<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class Usuario extends Model {
    protected $table = 'usuario';

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}