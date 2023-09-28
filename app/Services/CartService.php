<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Product;


class CartService
{
    public function viewStore(){
        $cart = session('cart', new Cart());
        $products = Product::all();

        return view('cart', compact('cart','products'));
    }
    public function addToCart($request, $productId)
    {
        // Retrieve the selected product by ID
        $product = Product::find($productId);

        if (!$product) {
            // Handle product not found error
        }

        // Add the product to the cart
        $cart = session('cart', new Cart());
        $cart->add($product);

        $product_ids = session('products_list');
        // Store the cart in the session
        session(['cart' => $cart]);
        $product_ids[] = $product->id;
        session(['products_list' => $product_ids]);
        return redirect()->back();
    }
    public function calculateInvoice()
    {
        $cart = session('cart', new Cart());
        $subtotal = $cart->calculateTotal();
        $vat = VatCalculator::calculate($subtotal);

        // Determine the shipping country (you can set this dynamically)
        $shippingCountry = Country::find(1); // Replace 1 with the actual country ID

        $shippingFees = ShippingCalculator::calculate($cart, $shippingCountry);

        $discounts = [];
        // Apply discounts
        $cartNames= (!empty(session('products_list')))? Product::whereIn('id',session('products_list'))->pluck('name')->toArray() :[];

        if (in_array('Shoes', $cartNames)) {
            $shoesDiscount = Product::where(['name'=>'Shoes'])->first()->price * 0.10;
            $discounts['10% off shoes'] = $shoesDiscount;
        }

        $topsCount = count(array_intersect(['T-shirt', 'Blouse'], $cartNames));
        $jacketCount = count(array_intersect(['Jacket'], $cartNames));
        if ($topsCount >= 2 && $jacketCount > 0) {
            $jacketDiscount = Product::where(['name'=>'Jacket'])->first()->price * 0.50;
            $discounts['50% off jacket'] = $jacketDiscount;
        }

        if (count($cart->getItems()) >= 2) {
            $discounts['$10 off shipping'] = 10;
        }
        return view('invoice', compact('cart', 'subtotal', 'vat', 'shippingFees', 'discounts'));
    }

}
