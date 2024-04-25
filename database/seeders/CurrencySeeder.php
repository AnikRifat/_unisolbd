<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            'country' => 'Bangladesh',
            'currency' => 'taka',
            'code' => 'tk',
            'symbol' => '৳',
            'status' => 1,
        ];

        Currency::insert($currency);
    }
}
