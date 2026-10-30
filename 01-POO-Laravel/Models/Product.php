<?php

namespace App\Models;

class Product {
    public function __construct(
        private string $name,
        private float $price,
    ){
        $this->name = $name;
        $this->price = $price;
    }
    public function showProduct () {
        echo $this->name . ' - $' . $this->price . PHP_EOL;
    }
    public function getName () {
        return $this->name;
    }
    public function getPrice () {
        return $this->price;
    }
}