<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Exception;

class Model
{
  private string $table;
  private PDO $pdo;

  public function __construct(string $table)
  {
    $this->table = $table;
    $this->pdo = Database::getConnection();
  }

  private function handleException(string $message, int $code)
  {
    // TODO: Implement later
    var_dump($message);
    exit;
  }

  public function all(int $limit = 0): ?array
  {
    try {
      $query = "SELECT * FROM $this->table";

      $stmt = $this->pdo->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $pDOException) {
      $this->handleException($pDOException->getMessage(), $pDOException->getCode());
    }
  }

  public function getOne(string $field): bool|object|null
  {
    try {
      if (!in_array($field, array_keys((array) $this))) {
        throw new Exception("The property $field does not exist on the object");
      }
    } catch (Exception $exception) {
      $this->handleException($exception->getMessage(), $exception->getCode());
    }

    try {
      $column = $field;
      $value = $this->$field;

      $query = "SELECT * FROM $this->table WHERE $column = :$column LIMIT 1";

      $stmt = $this->pdo->prepare($query);

      $stmt->bindValue(":$column", $value);

      $stmt->execute();

      return $stmt->fetchObject(get_called_class());
    } catch (PDOException $pDOException) {
      $this->handleException($pDOException->getMessage(), $pDOException->getCode());
      return null;
    }
  }

  public function store()
  {
    try {
      $query = "INSERT INTO $this->table (";

      $data = [];
      $fields = (array) $this;

      foreach ($fields as $key => $value) {
        if ($key != 'id' && !empty($value) && isset($value)) {
          if (strstr($key, 'App\Models\Model')) {
            continue;
          }
          $data[$key] = $value;
        }
      }

      $dataKeys = array_keys($data);

      foreach ($dataKeys as $value) {
        $query .= $value . ', ';
      }
      $query = substr($query, 0, -2);
      $query .= ') VALUES (';

      foreach ($dataKeys as $value) {
        $query .= ':' . $value . ', ';
      }
      $query = substr($query, 0, -2);
      $query .= ')';

      $stmt = $this->pdo->prepare($query);

      foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
      }

      return $stmt->execute();
    } catch (PDOException $pDOException) {
      $this->handleException($pDOException->getMessage(), $pDOException->getCode());
    }
  }
}