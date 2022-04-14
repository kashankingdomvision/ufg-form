<?php

use Illuminate\Database\Seeder;
use App\TourContact;

class TourContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tour_contacts  = [
            'Kashan',
            'Muno Mandizha',
            'Pietro Molica Lazzaro',
            'Natalie Jurcic',
            'Perian Johnson',
            'Ally Lewing',
            'Luke Stapylton-Smith',
            'Gemma D’Souza',
            'Nora Frohberg',
            'Graham Carter',
        ];

        foreach ($tour_contacts as $key => $value) {

            TourContact::create([
                'name'        => $value,
                'created_at'  => now(),
                'created_at'  => now(),
            ]);
        }
        
    }
}
