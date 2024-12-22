<?php
namespace App\Repositories;

use PDO;

class ProductRepository {
    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT id, sku, name, price, type, size, weight, height, width, length FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Get all products
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Attach specific attributes based on the product type
        foreach ($products as &$product) {
            $product['attributes'] = $this->getAttributesForProductType($product);
        }

        return $products;
    }

    private function getAttributesForProductType($product) {
        // Check the product type and return the appropriate attributes
        switch ($product['type']) {
            case 'Furniture':
                return [
                    'dimensions' => "{$product['height']} x {$product['width']} x {$product['length']}"
                ];
            case 'Book':
                return [
                    'weight' => "{$product['weight']} KG"
                ];
            case 'DVD':
                return [
                    'size' => "{$product['size']} GB"
                ];
            default:
                return [];
        }
    }

    public function add(array $productData) {
        $query = "INSERT INTO products (sku, name, price, type, size, weight, height, width, length)
                  VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':sku' => $productData['sku'],
            ':name' => $productData['name'],
            ':price' => $productData['price'],
            ':type' => $productData['type'],
            ':size' => $productData['size'] ?? null,
            ':weight' => $productData['weight'] ?? null,
            ':height' => $productData['height'] ?? null,
            ':width' => $productData['width'] ?? null,
            ':length' => $productData['length'] ?? null,
        ]);

        return ['success' => true, 'id' => $this->conn->lastInsertId()];
    }

    public function deleteByIds(array $ids) {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $query = "DELETE FROM products WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);

        $stmt->execute($ids);
        return ['success' => true, 'deleted_count' => $stmt->rowCount()];
    }
}
