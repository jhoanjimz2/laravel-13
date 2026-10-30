<?php

namespace App\Models;
use App\Models\Product;

class PhysicalProduct extends Product {

    public function __construct(
        string $name,
        float $price,
        private int $stock,
        private float $weight,
    ){
        parent::__construct($name, $price);
    }

}