<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Country;

class ShippingCalculator
{
    public static function calculate(Cart $cart, Country $country)
    {
        $shippingFees = 0;
//        dd($cart->getItems());
        $shippingRates = Country::pluck('shipping_rate','name')->toArray();
//dd($cart->getItems());
        foreach ($cart->getItems() as $item) {
            $shippingRate = $shippingRates[$item->getProduct()->shipped_from];

            $shippingFees += ($item->getProduct()->weight * 10) * $shippingRate ;
        }

        // Shipping rate per 100 grams based on country



        return $shippingFees;
    }
}
