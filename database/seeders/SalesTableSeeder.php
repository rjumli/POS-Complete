<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sales')->delete();
        
        \DB::table('sales')->insert(array (
            0 => 
            array (
                'id' => 3,
                'code' => 'SLS20231126-0001',
                'subtotal' => '1000.00',
                'discount' => '0.00',
                'tax' => '120.00',
                'total' => '1120.00',
                'status_id' => 24,
                'payment_id' => 19,
                'customer_id' => 1,
                'discount_id' => 1,
                'created_at' => '2023-11-26 16:47:53',
                'updated_at' => '2023-11-26 16:47:53',
            ),
            1 => 
            array (
                'id' => 4,
                'code' => 'SLS20231126-0002',
                'subtotal' => '200.00',
                'discount' => '0.00',
                'tax' => '24.00',
                'total' => '224.00',
                'status_id' => 24,
                'payment_id' => 19,
                'customer_id' => 1,
                'discount_id' => 1,
                'created_at' => '2023-11-26 18:52:31',
                'updated_at' => '2023-11-26 18:52:31',
            ),
            2 => 
            array (
                'id' => 5,
                'code' => 'SLS20231126-0003',
                'subtotal' => '4450.00',
                'discount' => '0.00',
                'tax' => '534.00',
                'total' => '4984.00',
                'status_id' => 24,
                'payment_id' => 19,
                'customer_id' => 1,
                'discount_id' => 1,
                'created_at' => '2023-11-26 19:32:01',
                'updated_at' => '2023-11-26 19:32:01',
            ),
        ));
        
        
    }
}