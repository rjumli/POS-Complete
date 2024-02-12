<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'classification' => 'Home',
                'id' => 37,
                'name' => 'Home',
            ),
            1 => 
            array (
                'classification' => 'Cashiering',
                'id' => 38,
                'name' => 'Cashiering',
            ),
            2 => 
            array (
                'classification' => 'Inventory',
                'id' => 39,
                'name' => 'Product Management',
            ),
            3 => 
            array (
                'classification' => 'Inventory',
                'id' => 40,
                'name' => 'Package Management',
            ),
            4 => 
            array (
                'classification' => 'Inventory',
                'id' => 41,
                'name' => 'Customer Return',
            ),
            5 => 
            array (
                'classification' => 'Inventory',
                'id' => 42,
                'name' => 'Supplier Return',
            ),
            6 => 
            array (
                'classification' => 'Product Stocking',
                'id' => 43,
                'name' => 'Purchased Order',
            ),
            7 => 
            array (
                'classification' => 'Product Stocking',
                'id' => 44,
                'name' => 'Deliveries',
            ),
            8 => 
            array (
                'classification' => 'Reports',
                'id' => 45,
                'name' => 'Inventory Report',
            ),
            9 => 
            array (
                'classification' => 'Reports',
                'id' => 46,
                'name' => 'Re-order Report',
            ),
            10 => 
            array (
                'classification' => 'Reports',
                'id' => 47,
                'name' => 'Sales Report',
            ),
            11 => 
            array (
                'classification' => 'Reports',
                'id' => 48,
                'name' => 'Delivery Report',
            ),
            12 => 
            array (
                'classification' => 'Reports',
                'id' => 49,
                'name' => 'Stock Adjustment Report',
            ),
            13 => 
            array (
                'classification' => 'Reports',
                'id' => 50,
                'name' => 'Customer Return Report',
            ),
            14 => 
            array (
                'classification' => 'Reports',
                'id' => 51,
                'name' => 'Supplier Return Report',
            ),
            15 => 
            array (
                'classification' => 'Utility',
                'id' => 52,
                'name' => 'User Management',
            ),
            16 => 
            array (
                'classification' => 'Utility',
                'id' => 53,
                'name' => 'Backup and Restore',
            ),
            17 => 
            array (
                'classification' => 'Maintenance',
                'id' => 54,
                'name' => 'Customers',
            ),
            18 => 
            array (
                'classification' => 'Maintenance',
                'id' => 55,
                'name' => 'Pricing',
            ),
            19 => 
            array (
                'classification' => 'Maintenance',
                'id' => 56,
                'name' => 'Suppliers',
            ),
            20 => 
            array (
                'classification' => 'Maintenance',
                'id' => 57,
                'name' => 'Discount',
            ),
            55 => 
            array (
                'classification' => 'Maintenance',
                'id' => 58,
                'name' => 'Category and Unit',
            ),
            21 => 
            array (
                'classification' => 'Maintenance',
                'id' => 59,
                'name' => 'Terms & Conditions',
            ),
        ));
        
        
    }
}