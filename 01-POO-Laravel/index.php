<?php

require_once './vendor/autoload.php';

use App\Services\Cart;
use App\Services\TaxCalculator;
use App\Services\OrderService;
use App\Services\EmailService;
use App\Helpers\Money;
use App\Models\Product;
use App\Models\DigitalProduct;
use App\Models\PhysicalProduct;

// $keyboard = new Product('Teclado', 89, 99);
// $monitor = new Product('Monitor', 299, 10);
// $tablet = new Product('Tablet', 199, 20);

$course = new DigitalProduct(
    'Curso laravel',
    99,
    'https://www.laravelphp.com'
);

$keyboard = new PhysicalProduct('Teclado', 89, 10, 1000);


$taxCalculator = new TaxCalculator();
$cart = new Cart($taxCalculator);
$order = new OrderService(new EmailService());

$cart->addProduct($keyboard);
$cart->addProduct($course);
$cart->showCart();
// $cart->addProduct($tablet);


echo Money::format($cart->total()) . PHP_EOL;

$order->createOrder();

// $course->showProduct();
// $keyboard->showProduct();