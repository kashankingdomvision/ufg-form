<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserFactory::class);
        $this->call([
            BrandAndHolidayTableSeeder::class,
            CurrencyTableSeeder::class,
            RoleTableSeeder::class, 
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            BookingMethodSeeder::class,
            BookingTypeSeeder::class,
            CurrencyConversionSeeder::class,
            InitialTableSeeder::class,
            ProductTableSeeder::class,
            PaymentMethodSeeder::class,
            SeasonTableSeeder::class,
            SupplierTableSeeder::class,
            CommissionTableSeeder::class,
            ReferenceCredentialTableSeeder::class,
            BankTableSeeder::class,
            GroupTableSeeder::class,
            CommissionGroupTableSeeder::class,
        ]);
        // $users = factory(App\User::class, 5)->create();
    }
}
