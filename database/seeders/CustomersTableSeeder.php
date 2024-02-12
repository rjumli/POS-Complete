<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'contact' => '09123654789',
                'created_at' => '2023-12-11 19:59:37',
                'email' => 'customer@genpos8.com',
                'id' => 1,
                'is_active' => 1,
                'name' => 'Default',
                'updated_at' => '2023-12-11 19:59:37',
            ),
            1 => 
            array (
                'contact' => '001234567/',
                'created_at' => '2023-12-11 20:02:09',
                'email' => 'clarkster@yahoo.com',
                'id' => 2,
                'is_active' => 1,
                'name' => 'Clark Ster',
                'updated_at' => '2023-12-11 20:02:09',
            ),
        ));
        
        
    }
}