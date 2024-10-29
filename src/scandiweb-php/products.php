<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Require the necessary files directly
require 'database.php';
require 'ProductRepository.php';

try {
    // Instantiate Database and ProductRepository classes
    $database = new Database();
    $productRepo = new ProductRepository($database);

    // Fetch products and structure the result
    $products = $productRepo->getAllProducts();
    $result = array_map(function($product) {
        return [
            'id' => $product->getId(),
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'attributes' => $product->getSpecificAttributes(),
        ];
    }, $products);

    echo json_encode($result);
} catch (Exception $e) {
    // Return JSON error response
    echo json_encode(['error' => $e->getMessage()]);
}
