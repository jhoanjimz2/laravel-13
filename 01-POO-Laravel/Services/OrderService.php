<?php

namespace App\Services;

class OrderService {

    public function __construct(
        private EmailService $emailService
    ) {}

    public function createOrder () {
        echo 'Orden Creada...' . PHP_EOL;
        $this->emailService->send();
    }

}