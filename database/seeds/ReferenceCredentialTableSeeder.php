<?php

use Illuminate\Database\Seeder;
use App\ReferenceCredential;
class ReferenceCredentialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferenceCredential::create([
            'code'          => '1000.f07c6e03fa956656371a7226d6ebd576.78a5a1af693f0f2b6d389b8fe11633c4',
            'access_token'  => '1000.1a0bfcf822e78243bc120c5c2272f8b1.d87f1f3806698046f88bddd5bc91cf1d',        
            'refresh_token' => '1000.93747e52d8c3bb5611666cf01cbd3e84.3c185f593775e82635f3c52d22bcf5cf',        
        ]);
    }
}
