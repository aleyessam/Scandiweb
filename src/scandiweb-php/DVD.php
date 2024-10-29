<?php

class DVD extends Product {
    private float $size;

    public function __construct(string $sku, string $name, float $price, float $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getSpecificAttributes(): array {
        return ['Size' => $this->size . ' MB'];
    }
}
