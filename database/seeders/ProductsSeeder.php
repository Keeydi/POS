<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Department;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('code');
        $departments = Department::all()->keyBy('code');

        $products = [
            // Drinks (Bar)
            ['sku' => 'BEER-001', 'name' => 'Beer', 'category' => 'DRINKS', 'price' => 150, 'department' => 'BAR'],
            ['sku' => 'WINE-001', 'name' => 'Wine', 'category' => 'DRINKS', 'price' => 500, 'department' => 'BAR'],
            ['sku' => 'COCKTAIL-001', 'name' => 'Cocktail', 'category' => 'DRINKS', 'price' => 300, 'department' => 'BAR'],
            
            // Ladies Drinks (LD, commissionable)
            ['sku' => 'LD-BEER-001', 'name' => 'LD Beer', 'category' => 'LADIES_DRINKS', 'price' => 200, 'department' => 'LD', 'is_commissionable' => true, 'commission_type' => 'fixed', 'commission_value' => 50],
            ['sku' => 'LD-WINE-001', 'name' => 'LD Wine', 'category' => 'LADIES_DRINKS', 'price' => 600, 'department' => 'LD', 'is_commissionable' => true, 'commission_type' => 'fixed', 'commission_value' => 100],
            
            // Kitchen items
            ['sku' => 'SOUP-001', 'name' => 'Chicken Soup', 'category' => 'SOUP', 'price' => 180, 'department' => 'KITCHEN'],
            ['sku' => 'SALAD-001', 'name' => 'Caesar Salad', 'category' => 'SALAD_SANDWICHES', 'price' => 250, 'department' => 'KITCHEN'],
            ['sku' => 'STARTER-001', 'name' => 'Spring Rolls', 'category' => 'STARTERS_BARBITES', 'price' => 200, 'department' => 'KITCHEN'],
            ['sku' => 'PASTA-001', 'name' => 'Spaghetti Carbonara', 'category' => 'PASTA', 'price' => 350, 'department' => 'KITCHEN'],
            ['sku' => 'CHICKEN-001', 'name' => 'Grilled Chicken', 'category' => 'CHICKEN', 'price' => 400, 'department' => 'KITCHEN'],
            ['sku' => 'PORK-001', 'name' => 'Pork Chop', 'category' => 'PORK', 'price' => 450, 'department' => 'KITCHEN'],
            ['sku' => 'BEEF-001', 'name' => 'Beef Steak', 'category' => 'BEEF', 'price' => 600, 'department' => 'KITCHEN'],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categories[$product['category']]->id,
                'sku' => $product['sku'],
                'name' => $product['name'],
                'price' => $product['price'],
                'department_id' => $departments[$product['department']]->id,
                'is_commissionable' => $product['is_commissionable'] ?? false,
                'commission_type' => $product['commission_type'] ?? null,
                'commission_value' => $product['commission_value'] ?? null,
                'taxable' => true,
                'active' => true,
            ]);
        }
    }
}
