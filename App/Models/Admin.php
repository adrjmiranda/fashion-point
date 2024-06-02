<?php

namespace App\Models;

class Admin extends Model
{
  public int $id;
  public string $first_name;
  public string $last_name;
  public string $email;
  public string $password;
  public string $createdAt;
  public string $updatedAt;

  public function __construct()
  {
    parent::__construct('administrators');
  }
}