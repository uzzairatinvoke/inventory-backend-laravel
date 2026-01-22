<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('Please run User and Category seeders first!');
            return;
        }

        $products = [
            // Electronics
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with A17 Pro chip, titanium design, and advanced camera system.',
                'price' => 999.00,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'MacBook Pro 16"',
                'description' => 'Powerful laptop with M3 Pro chip, 16-inch display, and up to 22 hours battery life.',
                'price' => 2499.00,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Premium noise-cancelling wireless headphones with exceptional sound quality.',
                'price' => 399.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'Samsung 55" 4K Smart TV',
                'description' => 'Ultra HD Smart TV with HDR, voice control, and streaming apps.',
                'price' => 699.99,
                'stock' => 12,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
            ],

            // Clothing
            [
                'name' => 'Classic Denim Jeans',
                'description' => 'Comfortable and durable denim jeans in various sizes and fits.',
                'price' => 79.99,
                'stock' => 50,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
            ],
            [
                'name' => 'Cotton T-Shirt Pack',
                'description' => 'Pack of 3 premium cotton t-shirts in assorted colors.',
                'price' => 29.99,
                'stock' => 100,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
            ],
            [
                'name' => 'Winter Jacket',
                'description' => 'Warm and waterproof winter jacket with insulated lining.',
                'price' => 149.99,
                'stock' => 35,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
            ],

            // Home & Kitchen
            [
                'name' => 'Stainless Steel Cookware Set',
                'description' => '10-piece non-stick cookware set with pots, pans, and lids.',
                'price' => 199.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Home & Kitchen')->first()->id,
            ],
            [
                'name' => 'Coffee Maker',
                'description' => 'Programmable coffee maker with thermal carafe and auto-shutoff.',
                'price' => 89.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Home & Kitchen')->first()->id,
            ],
            [
                'name' => 'Memory Foam Mattress',
                'description' => 'Queen size memory foam mattress with cooling gel layer.',
                'price' => 599.99,
                'stock' => 8,
                'category_id' => $categories->where('name', 'Home & Kitchen')->first()->id,
            ],

            // Sports & Outdoors
            [
                'name' => 'Yoga Mat',
                'description' => 'Non-slip yoga mat with carrying strap, extra thick for comfort.',
                'price' => 34.99,
                'stock' => 60,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Lightweight running shoes with cushioned sole and breathable mesh.',
                'price' => 119.99,
                'stock' => 45,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
            ],
            [
                'name' => 'Camping Tent 4-Person',
                'description' => 'Waterproof camping tent with easy setup, sleeps 4 people.',
                'price' => 179.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
            ],

            // Books
            [
                'name' => 'The Great Gatsby',
                'description' => 'Classic American novel by F. Scott Fitzgerald.',
                'price' => 12.99,
                'stock' => 80,
                'category_id' => $categories->where('name', 'Books')->first()->id,
            ],
            [
                'name' => 'Programming Guide: Laravel',
                'description' => 'Comprehensive guide to Laravel PHP framework for web development.',
                'price' => 49.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Books')->first()->id,
            ],

            // Toys & Games
            [
                'name' => 'LEGO Classic Building Set',
                'description' => 'Creative building set with 790 pieces in various colors.',
                'price' => 39.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Toys & Games')->first()->id,
            ],
            [
                'name' => 'Chess Set',
                'description' => 'Premium wooden chess set with board and pieces.',
                'price' => 59.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Toys & Games')->first()->id,
            ],

            // Health & Beauty
            [
                'name' => 'Skincare Set',
                'description' => 'Complete skincare routine set with cleanser, toner, and moisturizer.',
                'price' => 79.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Health & Beauty')->first()->id,
            ],
            [
                'name' => 'Electric Toothbrush',
                'description' => 'Rechargeable electric toothbrush with multiple cleaning modes.',
                'price' => 69.99,
                'stock' => 35,
                'category_id' => $categories->where('name', 'Health & Beauty')->first()->id,
            ],

            // Automotive
            [
                'name' => 'Car Phone Mount',
                'description' => 'Magnetic car phone mount with adjustable arm and strong grip.',
                'price' => 24.99,
                'stock' => 50,
                'category_id' => $categories->where('name', 'Automotive')->first()->id,
            ],
            [
                'name' => 'Car Floor Mats Set',
                'description' => 'All-weather car floor mats, set of 4, custom fit.',
                'price' => 89.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Automotive')->first()->id,
            ],
        ];

        foreach ($products as $productData) {
            // Assign random user to each product
            $user = $users->random();
            $productData['user_id'] = $user->id;
            
            Product::create($productData);
        }
    }
}
