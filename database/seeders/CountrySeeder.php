<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'name' => 'US',
                'shipping_rate' => 2,
            ],
            [
                'name' => 'UK',
                'shipping_rate' => 3,
            ],
            [
                'name' => 'CN',
                'shipping_rate' => 2,
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
