<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Work', 'color' => '#3b82f6'],      // Blue
            ['name' => 'Personal', 'color' => '#10b981'],  // Green
            ['name' => 'Shopping', 'color' => '#f59e0b'],  // Amber
            ['name' => 'Health', 'color' => '#ef4444'],    // Red
            ['name' => 'Education', 'color' => '#8b5cf6'], // Purple
            ['name' => 'Finance', 'color' => '#06b6d4'],   // Cyan
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
