<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets including smartphones, laptops, tablets, and accessories.',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items including shirts, pants, dresses, and accessories.',
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Home improvement items, kitchen appliances, furniture, and decor.',
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment, outdoor gear, fitness accessories, and athletic wear.',
            ],
            [
                'name' => 'Books',
                'description' => 'Books, e-books, magazines, and educational materials across various genres.',
            ],
            [
                'name' => 'Toys & Games',
                'description' => 'Toys, board games, video games, puzzles, and entertainment products.',
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health products, beauty supplies, personal care items, and wellness products.',
            ],
            [
                'name' => 'Automotive',
                'description' => 'Car parts, accessories, tools, and automotive maintenance products.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
