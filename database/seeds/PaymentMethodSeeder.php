<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_methods = [
            [   
                'name' => 'Paypal',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name' => 'Credit Card',
                'created_at' =>  now(),
                'updated_at' =>  now()

            ],
        ];

        PaymentMethod::insert($payment_methods);
    }
}
