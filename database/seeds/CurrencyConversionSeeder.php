<?php

use Illuminate\Database\Seeder;
use App\CurrencyConversion;

class CurrencyConversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $currency_conversions = [
            [ 'from' => 'USD', 'to' => 'USD',  'live' => 1.00,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'EUR',  'live' => 0.84,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'GBP',  'live' => 0.73,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'AUD',  'live' => 1.31,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'USD',  'live' => 1.19,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'EUR',  'live' => 1.00,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'GBP',  'live' => 0.87,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'AUD',  'live' => 1.56,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'USD',  'live' => 1.38,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'EUR',  'live' => 1.16,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'GBP',  'live' => 1.00,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' =>' AUD',  'live' => 1.80,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ],  
            [ 'from' => 'AUD', 'to' => 'USD',  'live' => 0.76,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'GBP',  'live' => 0.55,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'EUR',  'live' => 0.64,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'AUD',  'live' => 1.00,  'manual' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
        ];

        CurrencyConversion::insert($currency_conversions);

    }
}
