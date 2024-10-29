<?php

class Product {
    private $id;
    private $sku;
    private $name;
    private $price;
    private $type;
    private $size;    // For DVD
    private $weight;  // For Book
    private $height;  // For Furniture
    private $width;   // For Furniture
    private $length;  // For Furniture

    public function __construct($id, $sku, $name, $price, $type, $size = null, $weight = null, $height = null, $width = null, $length = null) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->size = $size;
        $this->weight = $weight;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getId() {
        return $this->id;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getType() {
        return $this->type;
    }

    public function getSize() {
        return $this->size; // Getter for size
    }

    public function getWeight() {
        return $this->weight; // Getter for weight
    }

    public function getHeight() {
        return $this->height; // Getter for height
    }

    public function getWidth() {
        return $this->width; // Getter for width
    }

    public function getLength() {
        return $this->length; // Getter for length
    }

    public function getSpecificAttributes() {
        $attributes = [
            'DVD' => ['size' => $this->size . ' MB'],
            'Book' => ['weight' => $this->weight . ' Kg'],
            'Furniture' => [
                'dimensions' => "{$this->width}x{$this->height}x{$this->length}",
            ],
        ];

        return $attributes[$this->type] ?? [];
    }
}
