<?php

namespace App\Utils;

class Validations
{
  // Product
  const PATTERN_PRODUCT_COLOR = '/^rgb\((25[0-5]|2[0-4][0-9]|[01]?[0-9]{1,2}),\s*(25[0-5]|2[0-4][0-9]|[01]?[0-9]{1,2}),\s*(25[0-5]|2[0-4][0-9]|[01]?[0-9]{1,2})\)$/';
  const PATTERN_PRODUCT_NAME = '/^[a-zA-ZÀ-ÿ\s]+$/';
  const PATTERN_PRODUCT_STOCK = '/^[1-9]\d*$/';
  const ALLOWED_PRODUCT_SIZES = ['PP', 'P', 'M', 'G', 'GG'];
  const ALLOWED_IMAGE_EXT = ['png', 'jpg', 'jpeg'];

  const MiNIMUM_PRODUCT_NAME_LENGTH = 3;
  const MAXIMUM_PRODUCT_NAME_LENGTH = 255;
  const MAXIMUM_PRODUCT_DESCRIPTION_LENGTH = 300;
  const MAXIMUM_PRODUCT_COLORS_QUANTITY = 7;
  const MAXIMUM_PRODUCT_IMAGES_QUANTITY = 4;

  public static function validateProductName(string $name): bool|string
  {
    if (!preg_match(self::PATTERN_PRODUCT_NAME, $name)) {
      return "Only characters and spaces";
    }

    if (!strlen($name) > self::MAXIMUM_PRODUCT_NAME_LENGTH) {
      return "The name must be " . self::MiNIMUM_PRODUCT_NAME_LENGTH . " to " . self::MAXIMUM_PRODUCT_NAME_LENGTH . " characters long";
    }

    return true;
  }

  public static function validateProductDescription(string $description): bool|string
  {
    if (empty($description)) {
      return "Description cannot be empty";
    }

    if (!strlen($description) > self::MAXIMUM_PRODUCT_DESCRIPTION_LENGTH) {
      return "The description must have a maximum of " . self::MAXIMUM_PRODUCT_DESCRIPTION_LENGTH . " characters";
    }

    return true;
  }

  public static function validateProductPrice(float $price): bool|string
  {
    if (!is_float($price) || $price <= 0) {
      return "Invalid price";
    }

    return true;
  }

  public static function validateProductSizes(array $sizes): bool|string
  {
    if (empty($sizes)) {
      return "Size list cannot be empty";
    }

    foreach ($sizes as $size) {
      if (!in_array($size, self::ALLOWED_PRODUCT_SIZES)) {
        return "Invalid size list";
      }
    }

    $occurrences = array_count_values($sizes);
    foreach ($occurrences as $quantity) {
      if ($quantity > 1) {
        return "Invalid size list";
      }
    }

    return true;
  }

  public static function validateProductColors(array $colors): bool|string
  {
    if (empty($colors)) {
      return "Color list cannot be empty";
    }

    if (count($colors) > self::MAXIMUM_PRODUCT_COLORS_QUANTITY) {
      return "Only " . self::MAXIMUM_PRODUCT_COLORS_QUANTITY . " colors maximum allowed";
    }

    foreach ($colors as $color) {
      if (!preg_match(self::PATTERN_PRODUCT_COLOR, $color)) {
        return "Color list sent is incorrect";
      }
    }

    return true;
  }

  public static function validateProductStock(int $stock): bool|string
  {
    if (!preg_match(self::PATTERN_PRODUCT_STOCK, $stock)) {
      return "Incorrect stock value";
    }

    return true;
  }

  public static function validateProductImages(array $fileName): bool|string
  {
    if (count($fileName) === 0) {
      return "You must send at least one image";
    }

    if (count($fileName) > self::MAXIMUM_PRODUCT_IMAGES_QUANTITY) {
      return "Maximum of " . self::MAXIMUM_PRODUCT_IMAGES_QUANTITY . " images allowed";
    }

    foreach ($fileName as $name) {
      $fileExt = pathinfo($name, PATHINFO_EXTENSION);
      if (!in_array($fileExt, self::ALLOWED_IMAGE_EXT)) {
        return "Only images with type jpg, jpeg or png";
      }
    }

    return true;
  }

  public static function validateProduct(array $fields): array
  {
    $errors = [];

    foreach ($fields as $key => $value) {
      $validate = '';

      switch ($key) {
        case 'name':
          $validate = Validations::validateProductName($value);
          break;

        case 'description':
          $validate = Validations::validateProductDescription($value);
          break;

        case 'stock':
          $validate = Validations::validateProductStock($value);
          break;

        case 'price':
          $validate = Validations::validateProductPrice($value);
          break;

        case 'sizes':
          $validate = Validations::validateProductSizes($value);
          break;

        case 'colors':
          $validate = Validations::validateProductColors($value);
          break;

        case 'images':
          $validate = Validations::validateProductImages($value);
          break;
      }

      if (!empty($validate) && $validate !== true) {
        $errors[$key] = $validate;
      }
    }

    return $errors;
  }
}