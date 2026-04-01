<?php

namespace App\Models;

use PDO;
use App\Config\Database;

abstract class Model extends Database
{
  protected $pdo;
  protected $table;

  public function __construct()
  {
    $this->pdo = Database::getConnection();
  }
  public static function getDb()
  {
    return (new static())->pdo;
  }
  public static function getTable()
  {
    return (new static())->table;
  }
  public static function all()
  {
    $table = static::getTable();
    $stmt = static::getDb()->prepare("SELECT * FROM {$table}");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function find($id)
  {
    $table = static::getTable();
    $stmt = static::getDb()->prepare("SELECT * FROM {$table} WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
