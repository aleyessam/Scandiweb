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
    // Decode incoming JSON data
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!isset($data['sku'], $data['name'], $data['price'], $data['type'])) {
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    // Prepare database and repository
    $database = new Database();
    $connection = $database->getConnection();
    $productRepo = new ProductRepository($connection);
    $productController = new ProductController($productRepo);

    // Add product
    $response = $productController->addProduct($data);

    // Respond with the result
    echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
