<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SaleListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sale_lists')->delete();
        
        \DB::table('sale_lists')->insert(array (
            0 => 
            array (
                'id' => 2,
                'quantity' => 5,
                'price' => '200.00',
                'total' => '1000.00',
                'type' => 'Product',
                'status_id' => 27,
                'product_id' => 2,
                'package_id' => NULL,
                'sale_id' => 3,
                'created_at' => '2023-11-26 16:47:53',
                'updated_at' => '2023-11-26 16:47:53',
            ),
            1 => 
            array (
                'id' => 3,
                'quantity' => 1,
                'price' => '200.00',
                'total' => '200.00',
                'type' => 'Product',
                'status_id' => 27,
                'product_id' => 2,
                'package_id' => NULL,
                'sale_id' => 4,
                'created_at' => '2023-11-26 18:52:31',
                'updated_at' => '2023-11-26 18:52:31',
            ),
            2 => 
            array (
                'id' => 4,
                'quantity' => 1,
                'price' => '4450.00',
                'total' => '4450.00',
                'type' => 'Package',
                'status_id' => 27,
                'product_id' => NULL,
                'package_id' => 3,
                'sale_id' => 5,
                'created_at' => '2023-11-26 19:32:01',
                'updated_at' => '2023-11-26 19:32:01',
            ),
        ));
        
        
    }
}