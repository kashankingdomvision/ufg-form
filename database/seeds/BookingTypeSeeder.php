<?php

use Illuminate\Database\Seeder;
use App\BookingType;


class BookingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking_types = [
            [   
                'name' => 'Refundable',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name' => 'Non-Refundable',
                'created_at' =>  now(),
                'updated_at' =>  now()

            ],
        ];

        BookingType::insert($booking_types);
    }
}
