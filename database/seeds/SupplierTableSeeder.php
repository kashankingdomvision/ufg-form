<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use App\SupplierCategory;
use App\SupplierProduct;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'currency_id'   => 1,
                'name'  => 'tabraiz bukhari',
                'email' => 'm.tabriazbukhari@gmail.com',
                'phone' => '03024214334',
                'categories' => [2,4,5],
                'products' => 1,
            ],
            
            [
                'currency_id'   => 3,
                'name'  => 'Kevin Levin',
                'email' => 'kevinlevin@yahoo.co.uk',
                'phone' => '+92034973095',
                'products' => 2,
                'categories' => [3,1,5],
            ],
        ];
        
        foreach ($data as $supp) {
            $supplier = Supplier::create([
                'currency_id'   => $supp['currency_id'],
                'name'          => $supp['name'],       
                'email'         => $supp['email'],      
                'phone'         => $supp['phone'],      
            ]);
            foreach ($supp['categories'] as $cate) {
                SupplierCategory::create([
                    'supplier_id' => $supplier->id,
                    'category_id' => $cate,
                ]);
            }
            
            SupplierProduct::create([
                'supplier_id' => $supplier->id,
                'product_id'  =>  $supp['products'],
            ]);
        }
        
        
    }
}
