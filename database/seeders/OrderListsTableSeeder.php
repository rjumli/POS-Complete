<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_lists')->delete();
        
        \DB::table('order_lists')->insert(array (
            0 => 
            array (
                'created_at' => '2023-12-11 19:20:55',
                'id' => 1,
                'order_id' => 1,
                'price' => '20000.00',
                'product_id' => 1,
                'quantity' => 5,
                'received' => 5,
                'status_id' => 8,
                'updated_at' => '2023-12-11 19:22:33',
            ),
            1 => 
            array (
                'created_at' => '2023-12-11 19:51:22',
                'id' => 2,
                'order_id' => 2,
                'price' => '15000.00',
                'product_id' => 2,
                'quantity' => 5,
                'received' => 5,
                'status_id' => 8,
                'updated_at' => '2023-12-11 19:51:31',
            ),
        ));
        
        
    }
}