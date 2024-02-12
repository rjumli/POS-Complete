<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'brand' => 'Dewalt',
                'category_id' => 6,
                'code' => 'PRDCT20231211-0001',
                'created_at' => '2023-12-11 19:20:18',
                'id' => 1,
                'is_active' => 1,
                'name' => 'DeWalt 15 amps 12 in. Corded Compound Miter Saw',
                'price' => '20000.00',
                'pricing_id' => 2,
                'reorder' => 0,
                'size' => '5',
                'stock' => 0,
                'unit_id' => 13,
                'updated_at' => '2023-12-11 20:26:20',
                'warranty' => '1 Years',
            ),
            1 => 
            array (
                'brand' => 'Dewalt',
                'category_id' => 6,
                'code' => 'PRDCT20231211-0002',
                'created_at' => '2023-12-11 19:49:52',
                'id' => 2,
                'is_active' => 1,
                'name' => 'DeWalt 20V MAX 6-1/2 in. Cordless Brushed Circular Saw Tool Only',
                'price' => '15000.00',
                'pricing_id' => 2,
                'reorder' => 0,
                'size' => '10',
                'stock' => 0,
                'unit_id' => 13,
                'updated_at' => '2023-12-11 20:27:15',
                'warranty' => '6 Months',
            ),
        ));
        
        
    }
}