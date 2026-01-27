<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Drinks', 'code' => 'DRINKS', 'sort_order' => 1],
            ['name' => 'Soup', 'code' => 'SOUP', 'sort_order' => 2],
            ['name' => 'Salad And Sandwiches', 'code' => 'SALAD_SANDWICHES', 'sort_order' => 3],
            ['name' => 'Starters And BarBites', 'code' => 'STARTERS_BARBITES', 'sort_order' => 4],
            ['name' => 'Seafood', 'code' => 'SEAFOOD', 'sort_order' => 5],
            ['name' => 'Pasta', 'code' => 'PASTA', 'sort_order' => 6],
            ['name' => 'Chicken', 'code' => 'CHICKEN', 'sort_order' => 7],
            ['name' => 'Pork', 'code' => 'PORK', 'sort_order' => 8],
            ['name' => 'Beef', 'code' => 'BEEF', 'sort_order' => 9],
            ['name' => 'Group Meals', 'code' => 'GROUP_MEALS', 'sort_order' => 10],
            ['name' => 'Ladies Drinks', 'code' => 'LADIES_DRINKS', 'sort_order' => 11],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
