<?php

namespace App\Helpers;

use App\Models\Cart;

class InvoiceCalculator
{

    public static function calculateInvoice(Cart $cart)
    {
        $subtotal = $cart->calculateSubtotal();
        $vat = $cart->calculateVAT($subtotal);
        $shippingFees = $cart->calculateShippingFees();

        // Apply discounts
        $discounts = [];
        $discounts[] = self::applyShoesDiscount($cart);
        $discounts[] = self::applyTopsJacketDiscount($cart);

        // Calculate total after applying discounts
        $total = $subtotal + $vat + $shippingFees - array_sum($discounts);

        return [
            'subtotal' => $subtotal,
            'vat' => $vat,
            'shipping_fees' => $shippingFees,
            'discounts' => $discounts,
            'total' => $total,
        ];
    }

    public static function applyShoesDiscount(Cart $cart)
    {
        // Check if there are shoes in the cart
        $shoes = $cart->getItemsByProductType('Shoes');

        if (count($shoes) > 0) {
            // Calculate the total price of shoes and apply a 10% discount
            $shoesTotal = array_sum(array_map(function ($item) {
                return $item->getTotal();
            }, $shoes));
            $discount = $shoesTotal * 0.10;
            return [
                'name' => '10% off shoes',
                'amount' => $discount,
            ];
        }

        return null;
    }

    public static function applyTopsJacketDiscount(Cart $cart)
    {
        // Check if there are two tops (t-shirt or blouse) and a jacket in the cart
        $tops = $cart->getItemsByProductType(['T-shirt', 'Blouse']);
        $jacket = $cart->getItemsByProductType('Jacket');

        if (count($tops) >= 2 && count($jacket) > 0) {
            // Find the cheapest top and apply 50% discount on the jacket
            $cheapestTop = min($tops, function ($top1, $top2) {
                return $top1->getTotal() - $top2->getTotal();
            });
            $jacketDiscount = $jacket[0]->getTotal() * 0.50;

            return [
                'name' => 'Buy 2 tops and get 50% off jacket',
                'amount' => $jacketDiscount,
            ];
        }

        return null;
    }
}
