<?php
namespace App\Models;

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($id, $sku, $name, $price, $height, $width, $length) {
        parent::__construct($id, $sku, $name, $price, 'Furniture');
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getSpecificAttributes() {
        return ['dimensions' => "{$this->height} x {$this->width} x {$this->length}"];
    }
}
