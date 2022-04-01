<?php

use Illuminate\Database\Seeder;
use App\CabinType;

class CabinTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabin_types = ['Timber Frame Cabin', 'Full Scribe Cabin', 'Post and Beam Log Cabin', 'Chink Cabin', 'Modular Cabin'];

        foreach ($cabin_types as $cabin_type) {

            CabinType::create([
                'name' => $cabin_type,
            ]);
        }
    }
}
