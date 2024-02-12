<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('packages')->delete();
        
        \DB::table('packages')->insert(array (
            0 => 
            array (
                'category_id' => 6,
                'code' => 'PCKG20231211-0001',
                'created_at' => '2023-12-11 19:52:09',
                'id' => 1,
                'information' => 'dewalt tools',
                'is_available' => 1,
                'name' => 'Dewalt Package Tools',
                'price' => '35000.00',
                'stock' => 1,
                'updated_at' => '2023-12-11 19:52:17',
            ),
        ));
        
        
    }
}