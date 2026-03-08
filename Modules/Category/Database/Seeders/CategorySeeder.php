<?php
namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'icon' => 'img/category/electronics.png', 'children' => ['Phones', 'Computers', 'Tablets', 'TVs']],
            ['name' => 'Vehicles', 'slug' => 'vehicles', 'icon' => 'img/category/car.png', 'children' => ['Cars', 'Motorcycles', 'Trucks', 'Boats']],
            ['name' => 'Real Estate', 'slug' => 'real-estate', 'icon' => 'img/category/home_garden.png', 'children' => ['For Sale', 'For Rent', 'Commercial']],
            ['name' => 'Fashion', 'slug' => 'fashion', 'icon' => 'img/category/phone.png', 'children' => ['Men', 'Women', 'Kids', 'Shoes']],
            ['name' => 'Home', 'slug' => 'home-garden', 'icon' => 'img/category/home_tools.png', 'children' => ['Furniture', 'Garden', 'Appliances']],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => 'img/category/sports.png', 'children' => ['Outdoor', 'Fitness', 'Team Sports']],
            ['name' => 'Jobs', 'slug' => 'jobs', 'icon' => 'img/category/education.png', 'children' => ['Full Time', 'Part Time', 'Freelance']],
            ['name' => 'Services', 'slug' => 'services', 'icon' => 'img/category/home_tools.png', 'children' => ['Cleaning', 'Repair', 'Education']],
        ];

        foreach ($categories as $index => $data) {
            $parent = Category::updateOrCreate(
                ['slug' => $data['slug']],
                ['name' => $data['name'], 'slug' => $data['slug'], 'icon' => $data['icon'], 'level' => 0, 'sort_order' => $index, 'is_active' => true]
            );

            foreach ($data['children'] as $i => $childName) {
                $childSlug = $data['slug'] . '-' . \Illuminate\Support\Str::slug($childName);
                Category::updateOrCreate(
                    ['slug' => $childSlug],
                    ['name' => $childName, 'slug' => $childSlug, 'parent_id' => $parent->id, 'level' => 1, 'sort_order' => $i, 'is_active' => true]
                );
            }
        }
    }
}
