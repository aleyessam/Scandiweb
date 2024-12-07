<?php
namespace App\Controllers;

use App\Repositories\ProductRepository;

class ProductController {
    private $productRepo;

    public function __construct(ProductRepository $productRepo) {
        $this->productRepo = $productRepo;
    }

    public function getAllProducts() {
        return $this->productRepo->getAll();
    }

    public function addProduct(array $data) {
        return $this->productRepo->add($data);
    }

    public function deleteProducts(array $ids) {
        return $this->productRepo->deleteByIds($ids);
    }
}
