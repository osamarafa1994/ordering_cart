<?php

namespace App\Services;

use App\Models\CartItem;

class DiscountShoes
{
    public static function apply(CartItem $item)
    {
        if ($item->getProduct()->name === 'Shoes') {
            // Apply 10% off for Shoes
            return $item->getTotal() * 0.10;
        }
        return 0;
    }
}
