<?php
namespace App;

use App\Config\Database;
use App\Repositories\ProductRepository;
use App\Controllers\ProductController;

require_once '../app/config/database.php';
require_once '../app/repositories/ProductRepository.php';
require_once '../app/controllers/ProductController.php';

header('Content-Type: application/json');

try {
    // Prepare database and repository
    $database = new Database();
    $connection = $database->getConnection();
    $productRepo = new ProductRepository($connection);
    $productController = new ProductController($productRepo);

    // Fetch all products
    $products = $productController->getAllProducts();

    // Return products as JSON
    echo json_encode(['success' => true, 'data' => $products]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
