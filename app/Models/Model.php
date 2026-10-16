<?php

namespace App\Models;

use PDO;
use App\Config\Database;

abstract class Model
{
    protected PDO $pdo;
    protected string $table;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    public static function getDb(): PDO
    {
        return (new static())->pdo;
    }

    public static function getTable(): string
    {
        return (new static())->table;
    }

    public static function all(): array
    {
        $table = static::getTable();

        $stmt = static::getDb()->query("SELECT * FROM {$table}");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int|string $id): array|null
    {
        $table = static::getTable();

        $stmt = static::getDb()->prepare(
            "SELECT * FROM {$table} WHERE id = :id LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result === false ? null : $result;
    }

    public static function create(array $data): string
    {
        if (empty($data)) {
            throw new InvalidArgumentException('Os dados são obrigatórios.');
        }

        $table = static::getTable();
        $columns = array_keys($data);

        foreach ($columns as $column) {
            if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)) {
                throw new InvalidArgumentException('Nome de coluna inválido.');
            }
        }

        $fields = implode(', ', $columns);
        $placeholders = implode(', ', array_map(
            fn(string $column): string => ':' . $column,
            $columns
        ));

        $stmt = static::getDb()->prepare(
            "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})"
        );

        $stmt->execute($data);

        return static::getDb()->lastInsertId();
    }

    public static function update(int|string $id, array $data): bool
    {
        if (empty($data)) {
            throw new InvalidArgumentException('Os dados são obrigatórios.');
        }

        $table = static::getTable();

        foreach (array_keys($data) as $column) {
            if (
                !preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)
                || $column === 'id'
            ) {
                throw new InvalidArgumentException('Nome de coluna inválido.');
            }
        }

        $fields = implode(', ', array_map(
            fn(string $column): string => "{$column} = :{$column}",
            array_keys($data)
        ));

        $stmt = static::getDb()->prepare(
            "UPDATE {$table} SET {$fields} WHERE id = :_id"
        );

        $stmt->execute([...$data, '_id' => $id]);

        return $stmt->rowCount() > 0;
    }

    public static function delete(int|string $id): bool
    {
        $table = static::getTable();

        $stmt = static::getDb()->prepare(
            "DELETE FROM {$table} WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }

    public static function exists(int|string $id): bool
    {
        $table = static::getTable();

        $stmt = static::getDb()->prepare(
            "SELECT 1 FROM {$table} WHERE id = :id LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetchColumn() !== false;
    }
}
