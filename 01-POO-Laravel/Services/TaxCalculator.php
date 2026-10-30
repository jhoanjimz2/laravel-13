<?php

namespace App\Services;

class TaxCalculator {

    public function calculate(float $amount) {
        return $amount * 0.16;
    }
}