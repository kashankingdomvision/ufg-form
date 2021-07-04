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
            [ 'from' => 'USD', 'to' => 'USD',  'live_rate' => 1.00,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'EUR',  'live_rate' => 0.84,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'GBP',  'live_rate' => 0.73,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'USD', 'to' => 'AUD',  'live_rate' => 1.31,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'USD',  'live_rate' => 1.19,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'EUR',  'live_rate' => 1.00,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'GBP',  'live_rate' => 0.87,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'EUR', 'to' => 'AUD',  'live_rate' => 1.56,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'USD',  'live_rate' => 1.38,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'EUR',  'live_rate' => 1.16,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' => 'GBP',  'live_rate' => 1.00,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'GBP', 'to' =>' AUD',  'live_rate' => 1.80,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ],  
            [ 'from' => 'AUD', 'to' => 'USD',  'live_rate' => 0.76,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'GBP',  'live_rate' => 0.55,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'EUR',  'live_rate' => 0.64,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
            [ 'from' => 'AUD', 'to' => 'AUD',  'live_rate' => 1.00,  'manual_rate' => '2.00', 'created_at' => now(), 'updated_at' => now() ], 
        ];

        CurrencyConversion::insert($currency_conversions);

    }
}
