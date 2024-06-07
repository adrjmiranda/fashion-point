<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;
use App\Utils\Validations;
use App\Models\Product as ProductModel;

class Product extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function productForm(Request $request, array $data = []): mixed
  {
    return $this->view('create-product', [
      'errors' => $data
    ]);
  }

  public function createProduct(Request $request)
  {
    $params = $request->getPostVars();

    $name = $params['name'] ?? '';
    $description = $params['description'] ?? '';
    $stock = $params['stock'] ?? '';
    $price = $params['price'] ?? '';
    $sizes = $params['sizes'] ?? [];
    $colors = $params['colors'] ?? [];

    $fileName = [];
    $fileTmp = [];
    $newFileName = [];

    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
      foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $fileName[] = $_FILES['images']['name'][$key];
        $fileTmp[] = $_FILES['images']['tmp_name'][$key];
        $newFileName[] = bin2hex(random_bytes(50)) . uniqid() . '.jpg';
      }
    }

    $fields = [
      'name' => $name,
      'description' => $description,
      'stock' => (int) $stock,
      'price' => (float) $price,
      'sizes' => $sizes,
      'colors' => $colors,
      'images' => $fileName
    ];

    $errors = Validations::validateProduct($fields);

    if (count($errors) > 0) {
      return $this->productForm($request, $errors);
    }

    $imageQtd = count($fileTmp);
    for ($i = 0; $i < $imageQtd; $i++) {
      if (!move_uploaded_file($fileTmp[$i], __DIR__ . "/../../../public/products/" . $newFileName[$i])) {
        $errors['image_filed'] = "Failed to save image";
        return $this->productForm($request, $errors);
      }
    }

    $product = new ProductModel;

    $product->name = trim($name);
    $product->description = trim($description);
    $product->stock = (int) trim($stock);
    $product->price = (float) trim($price);
    $product->sizes = json_encode($sizes);
    $product->colors = json_encode($colors);
    $product->images = json_encode($newFileName);

    if ($product->store()) {
      $request->getRouter()->redirect('/admin/dashboard/products');
    } else {
      $errors['insert_filed'] = "Failed to save product";
      return $this->productForm($request, $errors);
    }
  }
}