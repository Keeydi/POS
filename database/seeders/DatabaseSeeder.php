<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            DepartmentsSeeder::class,
            AreasAndTablesSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            StaffSeeder::class,
            UsersSeeder::class,
            BusinessSettingsSeeder::class,
        ]);
    }
}
