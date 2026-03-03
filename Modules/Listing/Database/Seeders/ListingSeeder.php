<?php
namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'partner@openclassify.com')->first();
        $categories = Category::where('level', 0)->get();

        if (!$user || $categories->isEmpty()) return;

        $listings = [
            ['title' => 'iPhone 14 Pro - Excellent Condition', 'price' => 799, 'city' => 'Istanbul', 'country' => 'Turkey'],
            ['title' => 'MacBook Pro 2023', 'price' => 1499, 'city' => 'Ankara', 'country' => 'Turkey'],
            ['title' => '2020 Toyota Corolla', 'price' => 18000, 'city' => 'New York', 'country' => 'United States'],
            ['title' => '3-Bedroom Apartment for Sale', 'price' => 250000, 'city' => 'Istanbul', 'country' => 'Turkey'],
            ['title' => 'Nike Running Shoes Size 42', 'price' => 89, 'city' => 'Berlin', 'country' => 'Germany'],
            ['title' => 'IKEA Dining Table', 'price' => 150, 'city' => 'London', 'country' => 'United Kingdom'],
            ['title' => 'Yoga Mat - Brand New', 'price' => 35, 'city' => 'Paris', 'country' => 'France'],
            ['title' => 'Web Developer for Hire', 'price' => 0, 'city' => 'Remote', 'country' => 'Turkey'],
            ['title' => 'Samsung 55" 4K TV', 'price' => 599, 'city' => 'Madrid', 'country' => 'Spain'],
            ['title' => 'Honda CBR500R Motorcycle 2021', 'price' => 6500, 'city' => 'Tokyo', 'country' => 'Japan'],
        ];

        foreach ($listings as $i => $listing) {
            $category = $categories->get($i % $categories->count());
            Listing::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($listing['title']) . '-' . ($i + 1)],
                array_merge($listing, [
                    'slug' => \Illuminate\Support\Str::slug($listing['title']) . '-' . ($i + 1),
                    'description' => 'This is a sample listing description for ' . $listing['title'],
                    'currency' => $listing['price'] > 0 ? 'USD' : 'USD',
                    'category_id' => $category?->id,
                    'user_id' => $user->id,
                    'status' => 'active',
                    'contact_email' => 'partner@openclassify.com',
                    'contact_phone' => '+1234567890',
                    'is_featured' => $i < 3,
                ])
            );
        }
    }
}
