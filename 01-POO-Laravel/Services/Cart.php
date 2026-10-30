<?php

namespace App\Services;

require_once './vendor/autoload.php';

use App\Models\Product;
use App\Services\TaxCalculator;

class Cart {
    public array $items = [];

    public function __construct(
        private TaxCalculator $taxCalculator
    ) {
    }

    public function addProduct(
        Product $product
    ) {
        $this->items[] = $product;
    }
    public function removeProduct(
        string $productName
    ) {
        foreach($this->items as $index => $item) {
            if ($item->getName() === $productName) {
                unset($this->items[$index]);
            }
        }
    }
    public function showCart() {
        foreach($this->items as $item) {
            echo $item->getName() . ' - $' . $item->getPrice() . PHP_EOL;
        }
    }
    public function subtotal() {
        $total = 0;
        foreach($this->items as $item) {
            $total += $item->getPrice();
        }
        return $total;
    }
    public function total() {
        return $this->subtotal() + $this->taxCalculator->calculate($this->subtotal());
    }
}