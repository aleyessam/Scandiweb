<?php

class ProductFactory
{
    public static function createProduct(array $data): Product
    {
        $class = ucfirst($data['type']); // Class name based on type

        if (!class_exists($class)) {
            throw new Exception("Product type '{$data['type']}' not recognized.");
        }

        return new $class(...$data['attributes']);
    }
}
