<?php
namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'icon' => 'laptop', 'children' => ['Phones', 'Computers', 'Tablets', 'TVs']],
            ['name' => 'Vehicles', 'slug' => 'vehicles', 'icon' => 'car', 'children' => ['Cars', 'Motorcycles', 'Trucks', 'Boats']],
            ['name' => 'Real Estate', 'slug' => 'real-estate', 'icon' => 'home', 'children' => ['For Sale', 'For Rent', 'Commercial']],
            ['name' => 'Fashion', 'slug' => 'fashion', 'icon' => 'shirt', 'children' => ['Men', 'Women', 'Kids', 'Shoes']],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'icon' => 'sofa', 'children' => ['Furniture', 'Garden', 'Appliances']],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => 'football', 'children' => ['Outdoor', 'Fitness', 'Team Sports']],
            ['name' => 'Jobs', 'slug' => 'jobs', 'icon' => 'briefcase', 'children' => ['Full Time', 'Part Time', 'Freelance']],
            ['name' => 'Services', 'slug' => 'services', 'icon' => 'wrench', 'children' => ['Cleaning', 'Repair', 'Education']],
        ];

        foreach ($categories as $index => $data) {
            $parent = Category::firstOrCreate(
                ['slug' => $data['slug']],
                ['name' => $data['name'], 'slug' => $data['slug'], 'icon' => $data['icon'], 'level' => 0, 'sort_order' => $index, 'is_active' => true]
            );

            foreach ($data['children'] as $i => $childName) {
                $childSlug = $data['slug'] . '-' . \Illuminate\Support\Str::slug($childName);
                Category::firstOrCreate(
                    ['slug' => $childSlug],
                    ['name' => $childName, 'slug' => $childSlug, 'parent_id' => $parent->id, 'level' => 1, 'sort_order' => $i, 'is_active' => true]
                );
            }
        }
    }
}
