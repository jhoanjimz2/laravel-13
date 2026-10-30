<?php

namespace App\Helpers;

class Money {
    public static function format(float $amount) {
        return "$" . number_format($amount, 2);
    }
}