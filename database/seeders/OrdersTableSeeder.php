<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'code' => 'ORDER20231211-0001',
                'created_at' => '2023-12-11 19:20:55',
                'id' => 1,
                'status_id' => 5,
                'supplier_id' => 4,
                'total' => '100000.00',
                'updated_at' => '2023-12-11 19:22:33',
            ),
            1 => 
            array (
                'code' => 'ORDER20231211-0002',
                'created_at' => '2023-12-11 19:51:22',
                'id' => 2,
                'status_id' => 5,
                'supplier_id' => 4,
                'total' => '75000.00',
                'updated_at' => '2023-12-11 19:51:31',
            ),
        ));
        
        
    }
}