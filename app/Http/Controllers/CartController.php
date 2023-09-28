<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Product;
use App\Services\CartService;
use App\Services\DiscountShoes;
use App\Services\ShippingCalculator;
use App\Services\VatCalculator;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function addToCart(Request $request, $productId)
    {
       return $this->cartService->addToCart($request, $productId);
    }

    public function viewCart()
    {
        return $this->cartService->viewStore();

    }

    public function generateInvoice()
    {
        return $this->cartService->calculateInvoice();
    }
}
