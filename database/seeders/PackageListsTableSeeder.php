<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('package_lists')->delete();
        
        \DB::table('package_lists')->insert(array (
            0 => 
            array (
                'created_at' => '2023-12-11 19:52:09',
                'id' => 1,
                'package_id' => 1,
                'price' => '20000.00',
                'product_id' => 1,
                'quantity' => 1,
                'total' => '20000.00',
                'updated_at' => '2023-12-11 19:52:09',
            ),
            1 => 
            array (
                'created_at' => '2023-12-11 19:52:09',
                'id' => 2,
                'package_id' => 1,
                'price' => '15000.00',
                'product_id' => 2,
                'quantity' => 1,
                'total' => '15000.00',
                'updated_at' => '2023-12-11 19:52:09',
            ),
        ));
        
        
    }
}