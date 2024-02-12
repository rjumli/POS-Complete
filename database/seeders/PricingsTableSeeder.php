<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricings')->delete();
        
        \DB::table('pricings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'percentage' => 0,
                'added_by' => 1,
                'created_at' => '2023-12-17 10:10:30',
                'updated_at' => '2023-12-17 10:10:30',
            ),
        ));
        
        
    }
}