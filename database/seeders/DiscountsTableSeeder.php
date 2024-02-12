<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('discounts')->delete();
        
        \DB::table('discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Regular',
                'value' => '0',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 12,
                'type_id' => 15,
                'subtype_id' => 18,
                'is_active' => 1,
                'created_at' => '2023-11-25 00:29:25',
                'updated_at' => '2023-11-25 00:29:25',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Student',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 12,
                'type_id' => 15,
                'subtype_id' => 18,
                'is_active' => 1,
                'created_at' => '2023-11-25 00:40:25',
                'updated_at' => '2023-11-25 00:40:25',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Senior Citizen',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 12,
                'type_id' => 15,
                'subtype_id' => 18,
                'is_active' => 1,
                'created_at' => '2023-11-25 00:40:37',
                'updated_at' => '2023-11-25 00:40:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Persons with Disabilities',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 12,
                'type_id' => 15,
                'subtype_id' => 18,
                'is_active' => 1,
                'created_at' => '2023-11-25 00:41:11',
                'updated_at' => '2023-11-25 00:41:11',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'New Year Sale',
                'value' => '10',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 16,
                'subtype_id' => 18,
                'is_active' => 0,
                'created_at' => '2023-11-26 21:16:34',
                'updated_at' => '2023-11-26 22:25:15',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '20% Sale',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 13,
                'type_id' => 16,
                'subtype_id' => 18,
                'is_active' => 0,
                'created_at' => '2023-11-26 22:26:53',
                'updated_at' => '2023-11-26 22:26:53',
            ),
        ));
        
        
    }
}