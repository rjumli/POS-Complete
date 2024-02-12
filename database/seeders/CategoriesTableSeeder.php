<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'is_active' => 1,
                'name' => 'Appliances',
            ),
            1 => 
            array (
                'id' => 2,
                'is_active' => 1,
                'name' => 'Automotive',
            ),
            2 => 
            array (
                'id' => 3,
                'is_active' => 1,
                'name' => 'Electrical',
            ),
            3 => 
            array (
                'id' => 4,
                'is_active' => 1,
                'name' => 'Hardware',
            ),
            4 => 
            array (
                'id' => 5,
                'is_active' => 1,
                'name' => 'Houseware',
            ),
            5 => 
            array (
                'id' => 6,
                'is_active' => 1,
                'name' => 'Tools',
            ),
            6 => 
            array (
                'id' => 7,
                'is_active' => 1,
                'name' => 'Outdoor & Living',
            ),
        ));
        
        
    }
}