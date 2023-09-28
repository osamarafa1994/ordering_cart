<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }



    public function add(Product $product)
    {
        $product_ids = session('products_list');
//        dd($product_ids);
//foreach ($product_ids as $id){
    $this->items[] = new CartItem($product);

//}
    }

    public function calculateTotal()
    {
        $subtotal = 0;
        $product_ids = session('products_list');

        if(!empty($product_ids)) {
            foreach ($product_ids as $id) {
                $this->items[] = new CartItem(Product::find($id));
            }
        }
        foreach ($this->items as $item) {
            $subtotal += $item->getTotal();
        }
        return $subtotal;
    }



    public function getItemsByProductType($productType)
    {
        // Filter cart items based on product type(s)
        return $this->items->filter(function ($item) use ($productType) {
            // If $productType is an array, check if the item's product type is in the array
            if (is_array($productType)) {
                return in_array($item->getProductType(), $productType);
            }
            // If $productType is a string, check if the item's product type matches
            return $item->getProductType() === $productType;
        });
    }
}
