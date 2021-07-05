<?php

use Illuminate\Database\Seeder;
use App\BookingMethod;

class BookingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking_methods = [
            [   
                'name' => 'Supplier Own',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name' => 'Stuba',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name' => 'Webhotelier',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
        ];

        BookingMethod::insert($booking_methods);
    }
}
