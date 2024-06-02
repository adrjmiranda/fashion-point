<?php

namespace App\Config;

use PDO;

class Database
{
  private static ?PDO $pdo = null;
  public static function getConnection(): PDO
  {
    $dbName = $_ENV['DB_NAME'];
    $dbHost = $_ENV['DB_HOST'];
    $dbUser = $_ENV['DB_USER'];
    $dbPass = $_ENV['DB_PASS'];

    if (is_null(Database::$pdo)) {
      Database::$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

      // Set Fetch
      Database::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

      // Set Exceptions
      Database::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Database::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }

    return Database::$pdo;
  }
}