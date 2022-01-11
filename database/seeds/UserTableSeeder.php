<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = [
            [
                'role_id'             =>  1,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Kashan',
                'email'               =>  'kashan.kingdomvision@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Muno Mandizha',
                'email'               =>  'Muno.Mandizha@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Pietro Molica Lazzaro',
                'email'               =>  'Pietro.Molica.Lazzaro@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Natalie Jurcic',
                'email'               =>  'Natalie.Jurcic@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Perian Johnson',
                'email'               =>  'Perian.Johnson@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Ally Lewing',
                'email'               =>  'Ally.Lewing@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Luke Stapylton-Smith',
                'email'               =>  'Luke.Stapylton-Smith@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            
            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Gemma D’Souza',
                'email'               =>  'Gemma.D’Souza@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Nora Frohberg',
                'email'               =>  'Nora.Frohberg@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            [
                'role_id'             =>  2,
                'supervisor_id'       =>  NULL,
                'currency_id'         =>  1,
                'brand_id'            =>  1,
                'holiday_type_id'     =>  1,
                'commission_id'       =>  1,
                'commission_group_id' =>  1,
                'name'                =>  'Graham Carter',
                'email'               =>  'Graham.Carter@gmail.com',
                'email_verified_at'   =>  now(),
                'password'            =>  Hash::make(12345678),
                'created_at'          =>  now(),
                'updated_at'          =>  now()
            ],

            // [
            //     'role_id'             =>  5,
            //     'supervisor_id'       =>  NULL,
            //     'currency_id'         =>  2,
            //     'brand_id'            =>  1,
            //     'holiday_type_id'     =>  1,
            //     'commission_id'       =>  1,
            //     'commission_group_id' =>  2,
            //     'name'                =>  'Tabseer',
            //     'email'               =>  'tabseer@gmail.com',
            //     'email_verified_at'   =>  now(),
            //     'password'            =>  Hash::make(12345678),
            //     'created_at'          =>  now(),
            //     'updated_at'          =>  now()
            // ],

            // [
            //     'role_id'              =>  2,
            //     'supervisor_id'        =>  2,
            //     'currency_id'          =>  3,
            //     'commission_id'        =>  NULL,
            //     'commission_group_id'  =>  NULL,
            //     'brand_id'             =>  1,
            //     'holiday_type_id'      =>  1,
            //     'name'                 =>  'Muhammad Tabraiz',
            //     'email'                =>  'm.tabraizbukhari@gmail.com',
            //     'email_verified_at'    =>  now(),
            //     'password'             =>  Hash::make(12345678),
            //     'created_at'           =>  now(),
            //     'updated_at'           =>  now()
            // ],
            
            // [
            //     'role_id'             =>  6,
            //     'supervisor_id'       =>  null,
            //     'currency_id'         =>  3,
            //     'commission_id'       =>  NULL,
            //     'commission_group_id' =>  NULL,
            //     'brand_id'            =>  1,
            //     'holiday_type_id'     =>  1,
            //     'name'                =>  'louis Fonsi',
            //     'email'               =>  'louisfonis@gmail.com',
            //     'email_verified_at'   =>  now(),
            //     'password'            =>  Hash::make(12345678),
            //     'created_at'          =>  now(),
            //     'updated_at'          =>  now()
            // ],
        ];

        User::insert($users);
    }
}
