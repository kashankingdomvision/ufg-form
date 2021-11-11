<?php

use Illuminate\Database\Seeder;
use App\PresetComment;

class PresetCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [ 
            [ 'comment' => 'This is Dummy Comment' ],
            [ 'comment' => 'This is also Dummy Comment' ],
        ];

        PresetComment::insert($data);
    }
}
