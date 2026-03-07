<?php

namespace Modules\Listing\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;
use Modules\Listing\Models\ListingCustomField;
use Modules\Listing\Support\ListingCustomFieldSeedCatalog;

class ListingCustomFieldSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::seedableListingFieldCategories();
        $seededCount = 0;

        foreach ($categories as $category) {
            foreach (ListingCustomFieldSeedCatalog::payloadsFor($category) as $payload) {
                ListingCustomField::upsertSeeded($category, $payload);
                $seededCount++;
            }
        }

        if ($this->command) {
            $this->command->info("Seeded {$seededCount} listing custom fields for {$categories->count()} categories.");
        }
    }
}
