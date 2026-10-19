<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class Usuario extends Model
{
    protected string $table = 'usuario';

    public static function findByEmail(string $email): ?array
    {
        $table = static::getTable();

        $stmt = static::getDb()->prepare(
            "SELECT * FROM {$table} WHERE email = :email LIMIT 1"
        );

        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row === false ? null : $row;
    }

    public static function emailExists(string $email): bool
    {
        $table = static::getTable();

        $stmt = static::getDb()->prepare(
            "SELECT 1 FROM {$table} WHERE email = :email LIMIT 1"
        );

        $stmt->execute(['email' => $email]);

        return $stmt->fetchColumn() !== false;
    }
}
