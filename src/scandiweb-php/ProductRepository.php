<?php

require_once 'Product.php'; // Include the Product class

class ProductRepository {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();

        // Fetch the results as associative arrays
        $productsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Map the results to Product objects
        return array_map(function($productData) {
            return new Product(
                $productData['id'],
                $productData['sku'],
                $productData['name'],
                $productData['price'],
                $productData['type'],
                $productData['size'],
                $productData['weight'],
                $productData['height'],
                $productData['width'],
                $productData['length']
            );
        }, $productsData);
    }

    public function save(Product $product) {
        $stmt = $this->db->prepare("
            INSERT INTO products (sku, name, price, type, size, weight, height, width, length) 
            VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)
        ");

        $stmt->bindValue(':sku', $product->getSku());
        $stmt->bindValue(':name', $product->getName());
        $stmt->bindValue(':price', $product->getPrice());
        $stmt->bindValue(':type', $product->getType());

        // Bind size, weight, height, width, length directly from the Product object
        $stmt->bindValue(':size', $product->getSize() ?? null);   // Ensure the getter exists in Product
        $stmt->bindValue(':weight', $product->getWeight() ?? null); // Ensure the getter exists in Product
        $stmt->bindValue(':height', $product->getHeight() ?? null); // Ensure the getter exists in Product
        $stmt->bindValue(':width', $product->getWidth() ?? null);   // Ensure the getter exists in Product
        $stmt->bindValue(':length', $product->getLength() ?? null); // Ensure the getter exists in Product

        $stmt->execute();
    }

    public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
}

}
