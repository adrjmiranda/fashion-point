<?php

namespace App\Models;

class Product extends Model
{
  public int $id;
  public string $name;
  public string $description;
  public float $price;
  public string $sizes;
  public string $colors;
  public int $stock;
  public string $createdAt;
  public string $updatedAt;

  public function __construct()
  {
    parent::__construct('products');
  }
}