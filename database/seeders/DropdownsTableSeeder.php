<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'classification' => 'n/a',
                'color' => 'n/a',
                'id' => 1,
                'name' => 'n/a',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            1 => 
            array (
                'classification' => 'Pricing',
                'color' => 'n/a',
                'id' => 2,
                'name' => 'Fixed Price',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            2 => 
            array (
                'classification' => 'Pricing',
                'color' => 'n/a',
                'id' => 3,
                'name' => 'By unit',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            3 => 
            array (
                'classification' => 'Order',
                'color' => 'bg-warning',
                'id' => 4,
                'name' => 'Pending',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            4 => 
            array (
                'classification' => 'Order',
                'color' => 'bg-success',
                'id' => 5,
                'name' => 'Completed',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            5 => 
            array (
                'classification' => 'Order',
                'color' => 'bg-danger',
                'id' => 6,
                'name' => 'Cancelled',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            6 => 
            array (
                'classification' => 'Orderlist',
                'color' => 'bg-warning',
                'id' => 7,
                'name' => 'Pending',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            7 => 
            array (
                'classification' => 'Orderlist',
                'color' => 'bg-success',
                'id' => 8,
                'name' => 'Received',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            8 => 
            array (
                'classification' => 'Orderlist',
                'color' => 'bg-dark',
                'id' => 9,
                'name' => 'Not Available',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            9 => 
            array (
                'classification' => 'Orderlist',
                'color' => 'bg-danger',
                'id' => 11,
                'name' => 'Cancelled',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            10 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 12,
                'name' => 'Total Based',
                'others' => 'n/a',
                'type' => 'Based',
            ),
            11 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 13,
                'name' => 'Item Based',
                'others' => 'n/a',
                'type' => 'Based',
            ),
            12 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 14,
                'name' => 'Occasional',
                'others' => 'n/a',
                'type' => 'Based',
            ),
            13 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 15,
                'name' => 'Unlimited',
                'others' => 'n/a',
                'type' => 'Type',
            ),
            14 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 16,
                'name' => 'Limited',
                'others' => 'n/a',
                'type' => 'Type',
            ),
            15 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 17,
                'name' => 'Amount',
                'others' => 'n/a',
                'type' => 'Subtype',
            ),
            16 => 
            array (
                'classification' => 'Discount',
                'color' => 'bg-success',
                'id' => 18,
                'name' => 'Percentage',
                'others' => 'n/a',
                'type' => 'Subtype',
            ),
            17 => 
            array (
                'classification' => 'Payment',
                'color' => 'n/a',
                'id' => 19,
                'name' => 'Cash',
                'others' => 'n/a',
                'type' => 'Cash',
            ),
            18 => 
            array (
                'classification' => 'Payment',
                'color' => 'n/a',
                'id' => 20,
                'name' => 'Gcash',
                'others' => 'n/a',
                'type' => 'Online',
            ),
            19 => 
            array (
                'classification' => 'Payment',
                'color' => 'n/a',
                'id' => 21,
                'name' => 'Maya',
                'others' => 'n/a',
                'type' => 'Online',
            ),
            20 => 
            array (
                'classification' => 'Payment',
                'color' => 'n/a',
                'id' => 22,
                'name' => 'GrabPay',
                'others' => 'n/a',
                'type' => 'Online',
            ),
            21 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-warning',
                'id' => 23,
                'name' => 'Pending',
                'others' => 'text-warning',
                'type' => 'Sale',
            ),
            22 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-success',
                'id' => 24,
                'name' => 'Completed',
                'others' => 'text-success',
                'type' => 'Sale',
            ),
            23 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-danger',
                'id' => 25,
                'name' => 'Cancelled',
                'others' => 'text-danger',
                'type' => 'Sale',
            ),
            24 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-warning',
                'id' => 26,
                'name' => 'Pending',
                'others' => 'text-warning',
                'type' => 'Salelist',
            ),
            25 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-success',
                'id' => 27,
                'name' => 'Sold',
                'others' => 'text-success',
                'type' => 'Salelist',
            ),
            26 => 
            array (
                'classification' => 'Status',
                'color' => 'bg-danger',
                'id' => 28,
                'name' => 'Returned',
                'others' => 'text-danger',
                'type' => 'Salelist',
            ),
            27 => 
            array (
                'classification' => 'Product',
                'color' => 'n/a',
                'id' => 29,
                'name' => 'Specific Date',
                'others' => 'n/a',
                'type' => 'Discount',
            ),
            28 => 
            array (
                'classification' => 'Product',
                'color' => 'n/a',
                'id' => 30,
                'name' => 'Date Range',
                'others' => 'n/a',
                'type' => 'Discount',
            ),
            29 => 
            array (
                'classification' => 'Order',
                'color' => 'bg-info',
                'id' => 31,
                'name' => 'Incomplete',
                'others' => 'text-info',
                'type' => 'n/a',
            ),
            30 => 
            array (
                'classification' => 'Orderlist',
                'color' => 'bg-info',
                'id' => 32,
                'name' => 'Partial Delivery',
                'others' => 'n/a',
                'type' => 'n/a',
            ),
            31 => 
            array (
                'classification' => 'Reason',
                'color' => 'bg-danger',
                'id' => 33,
                'name' => 'Defectived',
                'others' => 'text-danger',
                'type' => 'customer',
            ),
            32 => 
            array (
                'classification' => 'Reason',
                'color' => 'bg-info',
                'id' => 34,
                'name' => 'Refund',
                'others' => 'text-info',
                'type' => 'customer',
            ),
            33 => 
            array (
                'classification' => 'Reason',
                'color' => 'bg-success',
                'id' => 36,
                'name' => 'Refunded',
                'others' => 'text-success',
                'type' => 'n/a',
            ),
            34 => 
            array (
                'classification' => 'Home',
                'color' => 'n/a',
                'id' => 37,
                'name' => 'Home',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            35 => 
            array (
                'classification' => 'Cashiering',
                'color' => 'n/a',
                'id' => 38,
                'name' => 'Cashiering',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            36 => 
            array (
                'classification' => 'Inventory',
                'color' => 'n/a',
                'id' => 39,
                'name' => 'Product Management',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            37 => 
            array (
                'classification' => 'Inventory',
                'color' => 'n/a',
                'id' => 40,
                'name' => 'Package Management',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            38 => 
            array (
                'classification' => 'Inventory',
                'color' => 'n/a',
                'id' => 41,
                'name' => 'Customer Return',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            39 => 
            array (
                'classification' => 'Inventory',
                'color' => 'n/a',
                'id' => 42,
                'name' => 'Supplier Return',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            40 => 
            array (
                'classification' => 'Product Stocking',
                'color' => 'n/a',
                'id' => 43,
                'name' => 'Purchased Order',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            41 => 
            array (
                'classification' => 'Product Stocking',
                'color' => 'n/a',
                'id' => 44,
                'name' => 'Deliveries',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            42 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 45,
                'name' => 'Inventory Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            43 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 46,
                'name' => 'Re-order Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            44 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 47,
                'name' => 'Sales Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            45 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 48,
                'name' => 'Delivery Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            46 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 49,
                'name' => 'Stock Adjustment Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            47 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 50,
                'name' => 'Customer Return Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            48 => 
            array (
                'classification' => 'Reports',
                'color' => 'n/a',
                'id' => 51,
                'name' => 'Supplier Return Report',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            49 => 
            array (
                'classification' => 'Utility',
                'color' => 'n/a',
                'id' => 52,
                'name' => 'User Management',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            50 => 
            array (
                'classification' => 'Utility',
                'color' => 'n/a',
                'id' => 53,
                'name' => 'Backup and Restore',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            51 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 54,
                'name' => 'Customers',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            52 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 55,
                'name' => 'Pricing',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            53 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 56,
                'name' => 'Suppliers',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            54 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 57,
                'name' => 'Discount',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            55 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 58,
                'name' => 'Category and Unit',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
            56 => 
            array (
                'classification' => 'Maintenance',
                'color' => 'n/a',
                'id' => 59,
                'name' => 'Terms & Conditions',
                'others' => 'n/a',
                'type' => 'Menu',
            ),
        ));
        
        
    }
}