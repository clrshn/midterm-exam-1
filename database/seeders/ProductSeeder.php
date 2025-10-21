<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Drinks
        Product::create(['name' => 'Coffee', 'price' => 120, 'stock' => 50]);
        Product::create(['name' => 'Milk', 'price' => 80, 'stock' => 30]);
        Product::create(['name' => 'Juice', 'price' => 90, 'stock' => 40]);
        Product::create(['name' => 'Soft Drink', 'price' => 50, 'stock' => 60]);

        // Food
        Product::create(['name' => 'Sugar', 'price' => 60, 'stock' => 40]);
        Product::create(['name' => 'Bread', 'price' => 50, 'stock' => 25]);
        Product::create(['name' => 'Rice', 'price' => 70, 'stock' => 100]);
        Product::create(['name' => 'Pasta', 'price' => 45, 'stock' => 70]);
        Product::create(['name' => 'Canned Tuna', 'price' => 35, 'stock' => 80]);

        // Snacks
        Product::create(['name' => 'Chips', 'price' => 30, 'stock' => 100]);
        Product::create(['name' => 'Biscuits', 'price' => 25, 'stock' => 90]);
        Product::create(['name' => 'Chocolate Bar', 'price' => 40, 'stock' => 60]);

        // Household
        Product::create(['name' => 'Soap', 'price' => 20, 'stock' => 200]);
        Product::create(['name' => 'Shampoo', 'price' => 150, 'stock' => 50]);
        Product::create(['name' => 'Toothpaste', 'price' => 75, 'stock' => 70]);
        Product::create(['name' => 'Detergent', 'price' => 95, 'stock' => 40]);

        // Fresh Produce
        Product::create(['name' => 'Apple', 'price' => 15, 'stock' => 150]);
        Product::create(['name' => 'Banana', 'price' => 10, 'stock' => 200]);
        Product::create(['name' => 'Tomato', 'price' => 12, 'stock' => 180]);
        Product::create(['name' => 'Potato', 'price' => 20, 'stock' => 160]);
    }
}
