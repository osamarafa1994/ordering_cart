<?php

namespace App\Services;

class VatCalculator
{
    public static function calculate($subtotal)
    {
        return $subtotal * 0.14; // 14% VAT
    }
}
