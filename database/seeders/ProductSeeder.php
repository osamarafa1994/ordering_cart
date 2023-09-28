<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'T-shirt',
                'price' => 30.99,
                'shipped_from' => 'US',
                'weight' => 0.2,
            ],
            [
                'name' => 'Blouse',
                'price' => 10.99,
                'shipped_from' => 'UK',
                'weight' => 0.3,
            ],
            [
                'name' => 'Pants',
                'price' => 64.99,
                'shipped_from' => 'UK',
                'weight' => 0.9,
            ],
            [
                'name' => 'Sweatpants',
                'price' => 84.99,
                'shipped_from' => 'CN',
                'weight' => 1.1,
            ],
            [
                'name' => 'Jacket',
                'price' => 199.99,
                'shipped_from' => 'US',
                'weight' => 2.2,
            ],
            [
                'name' => 'Shoes',
                'price' => 79.99,
                'shipped_from' => 'CN',
                'weight' => 1.3,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
