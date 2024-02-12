<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Feet',
                'shortcut' => 'ft',
                'conversion' => '',
                'type' => 'length',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Inches',
                'shortcut' => 'in',
                'conversion' => '',
                'type' => 'length',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Centimeters',
                'shortcut' => 'cm',
                'conversion' => '',
                'type' => 'length',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Meters',
                'shortcut' => 'm',
                'conversion' => '',
                'type' => 'length',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pounds',
                'shortcut' => 'lbs',
                'conversion' => '',
                'type' => 'Weight',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Kilograms',
                'shortcut' => 'kg',
                'conversion' => '',
                'type' => 'Weight',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Grams',
                'shortcut' => 'g',
                'conversion' => '',
                'type' => 'Weight',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Ounces',
                'shortcut' => 'oz',
                'conversion' => '',
                'type' => 'Weight',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Fluid Ounces',
                'shortcut' => 'fl oz',
                'conversion' => '',
                'type' => 'Volume',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Milliliters',
                'shortcut' => 'mL',
                'conversion' => '',
                'type' => 'Volume',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Liters',
                'shortcut' => 'L',
                'conversion' => '',
                'type' => 'Volume',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Gallons',
                'shortcut' => 'gal',
                'conversion' => '',
                'type' => 'Volume',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Piece',
                'shortcut' => 'pcs',
                'conversion' => '',
                'type' => 'Pieces',
            ),
        ));
        
        
    }
}