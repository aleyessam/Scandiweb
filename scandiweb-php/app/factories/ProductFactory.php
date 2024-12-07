<?php
namespace App\Factories;

use App\Models\Product;

class ProductFactory {
    public static function createProduct($sku, $name, $price, $type, $attributes) {
        return new Product(null, $sku, $name, $price, $type, $attributes);
    }
}
