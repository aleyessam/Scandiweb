<?php

class Book extends Product {
    private $weight;

    public function __construct($id, $sku, $name, $price, $weight) {
        parent::__construct($id, $sku, $name, $price, 'Book');
        $this->weight = $weight;
    }

    public function getSpecificAttributes() {
        return ['weight' => $this->weight . ' KG'];
    }
}
