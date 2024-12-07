<?php

require_once '../vendor/autoload.php';

use App\Config\Database;
use App\Repositories\ProductRepository;
use App\Factories\ProductFactory;
use App\Controllers\ProductController;

$database = new Database();
$productRepo = new ProductRepository($database);
$productFactory = new ProductFactory();

$productController = new ProductController($productRepo, $productFactory);

$action = $_GET['action'] ?? null;

if ($action === 'get') {
    $productController->getAllProducts();
} elseif ($action === 'add') {
    $productController->addProduct();
} else {
    echo json_encode(['error' => 'Invalid action']);
}
