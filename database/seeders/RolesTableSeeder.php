<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2023-12-19 02:11:44',
                'id' => 1,
                'name' => 'Administrator',
                'updated_at' => '2023-12-19 02:11:44',
            ),
            1 => 
            array (
                'created_at' => '2023-12-19 02:11:44',
                'id' => 2,
                'name' => 'Owner',
                'updated_at' => '2023-12-19 02:11:44',
            ),
            2 => 
            array (
                'created_at' => '2023-12-19 02:11:44',
                'id' => 3,
                'name' => 'Cashier',
                'updated_at' => '2023-12-19 02:11:44',
            ),
            3 => 
            array (
                'created_at' => '2023-12-19 02:11:44',
                'id' => 4,
                'name' => 'Assistant Clerk',
                'updated_at' => '2023-12-19 02:11:44',
            ),
            4 => 
            array (
                'created_at' => '2023-12-19 02:11:44',
                'id' => 5,
                'name' => 'Inventory Manager',
                'updated_at' => '2023-12-19 02:11:44',
            ),
        ));
        
        
    }
}