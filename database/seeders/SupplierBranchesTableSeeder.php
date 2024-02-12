<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierBranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('supplier_branches')->delete();
        
        \DB::table('supplier_branches')->insert(array (
            0 => 
            array (
                'address' => 'Manila, PH',
                'contact_number' => '091236544789',
                'contact_person' => 'Elma Uzon',
                'created_at' => '2023-12-11 19:14:18',
                'email' => 'elmayuzon@yahoo.com',
                'id' => 1,
                'is_active' => 1,
                'is_main' => 1,
                'name' => 'Philippines',
                'supplier_id' => 1,
                'updated_at' => '2023-12-11 19:14:18',
            ),
            1 => 
            array (
                'address' => 'Manila, PH',
                'contact_number' => '0911223344',
                'contact_person' => 'Mark Pure',
                'created_at' => '2023-12-11 19:15:05',
                'email' => 'markpure@yahoo.com',
                'id' => 2,
                'is_active' => 1,
                'is_main' => 1,
                'name' => 'Philippines',
                'supplier_id' => 2,
                'updated_at' => '2023-12-11 19:15:05',
            ),
            2 => 
            array (
                'address' => 'Taguig, PH',
                'contact_number' => '09312654987',
                'contact_person' => 'Albert Yu',
                'created_at' => '2023-12-11 19:15:48',
                'email' => 'albertyu@yahoo.com',
                'id' => 3,
                'is_active' => 1,
                'is_main' => 1,
                'name' => 'Philippines',
                'supplier_id' => 3,
                'updated_at' => '2023-12-11 19:15:48',
            ),
            3 => 
            array (
                'address' => 'Makati, PH',
                'contact_number' => '09321456987',
                'contact_person' => 'James Bond',
                'created_at' => '2023-12-11 19:17:38',
                'email' => 'jamesbond@yahoo.com',
                'id' => 4,
                'is_active' => 1,
                'is_main' => 1,
                'name' => 'Philippines',
                'supplier_id' => 4,
                'updated_at' => '2023-12-11 19:17:38',
            ),
        ));
        
        
    }
}