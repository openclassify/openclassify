<?php
namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $listings = [
            ['title' => 'iPhone 14 Pro - Like New', 'price' => 750, 'category_id' => 1, 'status' => 'active'],
            ['title' => 'Samsung Galaxy S23', 'price' => 550, 'category_id' => 1, 'status' => 'active'],
            ['title' => 'MacBook Pro 2023', 'price' => 1800, 'category_id' => 2, 'status' => 'active'],
            ['title' => '2019 Toyota Corolla', 'price' => 15000, 'category_id' => 3, 'status' => 'active'],
            ['title' => 'Apartment for Rent - 2BR', 'price' => 1200, 'category_id' => 4, 'status' => 'active'],
            ['title' => 'Sofa Set - Excellent Condition', 'price' => 350, 'category_id' => 5, 'status' => 'active'],
        ];

        foreach ($listings as $data) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
            $data['description'] = 'Great item in excellent condition. Contact for more details.';
            $data['contact_email'] = 'seller@example.com';
            $data['city'] = 'Istanbul';
            $data['country'] = 'Turkey';
            Listing::firstOrCreate(['title' => $data['title']], $data);
        }
    }
}
