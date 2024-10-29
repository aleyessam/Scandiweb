<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Require necessary files
require 'database.php';          // Include the Database class
require 'ProductRepository.php'; // Include the ProductRepository class

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if (!isset($data['ids']) || !is_array($data['ids'])) {
        echo json_encode(['error' => 'Invalid input']);
        exit;
    }

    // Instantiate Database and ProductRepository classes directly
    $database = new Database();
    $productRepo = new ProductRepository($database);

    foreach ($data['ids'] as $id) {
        $productRepo->delete($id); // Implement the delete method in ProductRepository
    }

    echo json_encode(['success' => true, 'message' => 'Products deleted successfully']);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
