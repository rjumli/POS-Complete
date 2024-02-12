<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('roles')->insert([
        //     'id' => 1,
        //     'name' => 'Administrator',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $this->call(RolesTableSeeder::class);
        \DB::table('users')->insert([
            'username' => 'administrator',
            'email' => 'admin@genpos8.com',
            'name' => 'John Doe',
            'password' => bcrypt('!@#$%^&*('),
            'role_id' => 1,
            'avatar' => 'administrator.png',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
        ]);
        $this->call(DropdownsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(SupplierBranchesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        // $this->call(OrderListsTableSeeder::class);
        // $this->call(PackagesTableSeeder::class);
        // $this->call(PackageListsTableSeeder::class);
        // $this->call(SalesTableSeeder::class);
        // $this->call(SaleListsTableSeeder::class);
        $this->call(PricingsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
    }
}
