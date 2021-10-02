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
                'name'       =>  'Refundable',
                'slug'       =>  Str::slug('Refundable'),
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name'       =>  'Partially Refundable',
                'slug'       =>  Str::slug('Partially Refundable'),
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name'       =>  'Non-Refundable',
                'slug'       =>  Str::slug('Non-Refundable'),
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
        ];

        BookingType::insert($booking_types);
    }
}
