<?php

namespace App\Models;
use App\Models\Product;

class DigitalProduct extends Product {

    public function __construct(
        private string $name,
        private float $price,
        public string $downloadUrl
    ){
        parent::__construct($name, $price);
    }
    public function showProduct () {
        echo $this->name . ' - $' . $this->price . ' - ' . $this->downloadUrl . PHP_EOL;
    }

}