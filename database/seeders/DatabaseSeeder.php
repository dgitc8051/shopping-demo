<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Product::create([
            'name' => 'MacBook Air',
            'price' => 29999,
            'stock' => 5,
            'category' => 'electronics',
            'description' => '輕薄筆電，適合外出工作'
        ]);

        Product::create([
            'name' => 'iPhone 15',
            'price' => 39999,
            'stock' => 8,
            'category' => 'electronics',
            'description' => '最新款手機，旗艦規格'
        ]);
    }
}
