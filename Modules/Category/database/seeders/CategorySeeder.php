<?php
namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'icon' => '📱', 'children' => ['Mobile Phones', 'Laptops & Computers', 'Tablets', 'Cameras', 'Audio']],
            ['name' => 'Vehicles', 'icon' => '🚗', 'children' => ['Cars', 'Motorcycles', 'Trucks', 'Boats']],
            ['name' => 'Real Estate', 'icon' => '🏠', 'children' => ['Apartments for Rent', 'Houses for Sale', 'Commercial', 'Land']],
            ['name' => 'Furniture', 'icon' => '🛋️', 'children' => ['Sofas', 'Beds', 'Tables', 'Wardrobes']],
            ['name' => 'Fashion', 'icon' => '👗', 'children' => ['Women', 'Men', 'Kids', 'Accessories']],
            ['name' => 'Jobs', 'icon' => '💼', 'children' => ['IT & Technology', 'Marketing', 'Sales', 'Education']],
            ['name' => 'Services', 'icon' => '🔧', 'children' => ['Home Repair', 'Tutoring', 'Design', 'Cleaning']],
            ['name' => 'Sports & Hobbies', 'icon' => '⚽', 'children' => ['Sports Equipment', 'Musical Instruments', 'Books', 'Games']],
        ];

        foreach ($categories as $catData) {
            $parent = Category::firstOrCreate(
                ['slug' => Str::slug($catData['name'])],
                ['name' => $catData['name'], 'icon' => $catData['icon'] ?? null, 'level' => 0, 'is_active' => true]
            );
            foreach ($catData['children'] as $childName) {
                Category::firstOrCreate(
                    ['slug' => Str::slug($childName)],
                    ['name' => $childName, 'parent_id' => $parent->id, 'level' => 1, 'is_active' => true]
                );
            }
        }
    }
}
