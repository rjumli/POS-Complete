<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suppliers')->delete();
        
        \DB::table('suppliers')->insert(array (
            0 => 
            array (
                'created_at' => '2023-12-11 19:13:40',
                'id' => 1,
                'is_active' => 1,
                'name' => 'Yeti',
                'updated_at' => '2023-12-11 19:13:40',
            ),
            1 => 
            array (
                'created_at' => '2023-12-11 19:14:39',
                'id' => 2,
                'is_active' => 1,
                'name' => 'Craftsman',
                'updated_at' => '2023-12-11 19:14:39',
            ),
            2 => 
            array (
                'created_at' => '2023-12-11 19:15:24',
                'id' => 3,
                'is_active' => 1,
                'name' => 'Scotts',
                'updated_at' => '2023-12-11 19:15:24',
            ),
            3 => 
            array (
                'created_at' => '2023-12-11 19:17:10',
                'id' => 4,
                'is_active' => 1,
                'name' => 'Dewalt',
                'updated_at' => '2023-12-11 19:17:10',
            ),
        ));
        
        
    }
}