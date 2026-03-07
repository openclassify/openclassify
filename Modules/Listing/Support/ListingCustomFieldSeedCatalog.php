<?php

namespace Modules\Listing\Support;

use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Listing\Models\ListingCustomField;

final class ListingCustomFieldSeedCatalog
{
    public static function payloadsFor(Category $category): array
    {
        $definitions = array_merge(
            self::familyDefinitions(self::rootSlug($category)),
            self::categoryDefinitions((string) $category->slug),
        );

        return collect($definitions)
            ->values()
            ->map(function (array $definition, int $index) use ($category): array {
                return [
                    'name' => self::fieldName((string) $category->slug, (string) $definition['name']),
                    'label' => (string) $definition['label'],
                    'type' => (string) $definition['type'],
                    'placeholder' => $definition['placeholder'] ?? null,
                    'help_text' => $definition['help_text'] ?? null,
                    'options' => $definition['options'] ?? null,
                    'is_required' => (bool) ($definition['is_required'] ?? false),
                    'is_active' => true,
                    'sort_order' => ($index + 1) * 10,
                ];
            })
            ->all();
    }

    private static function rootSlug(Category $category): string
    {
        $current = $category;

        while ($current->parent) {
            $current = $current->parent;
        }

        return (string) $current->slug;
    }

    private static function fieldName(string $categorySlug, string $name): string
    {
        return Str::slug($categorySlug . '_' . $name, '_');
    }

    private static function familyDefinitions(string $rootSlug): array
    {
        return match ($rootSlug) {
            'electronics' => [
                self::text('brand', 'Brand', 'Apple, Samsung, Sony'),
                self::text('model', 'Model', 'iPhone 14, XPS 13'),
                self::select('condition', 'Condition', ['New', 'Like New', 'Used', 'For Parts']),
                self::boolean('warranty_available', 'Warranty Available'),
            ],
            'vehicles' => [
                self::text('brand', 'Brand', 'Toyota, Honda, Ford'),
                self::text('model', 'Model', 'Corolla, Civic'),
                self::number('year', 'Year', '2021'),
                self::select('condition', 'Condition', ['New', 'Excellent', 'Good', 'Fair']),
            ],
            'real-estate' => [
                self::select('property_type', 'Property Type', ['Apartment', 'House', 'Villa', 'Office', 'Land', 'Shop']),
                self::number('area_sqm', 'Area (sqm)', '120'),
                self::boolean('furnished', 'Furnished'),
                self::date('available_from', 'Available From'),
            ],
            'fashion' => [
                self::text('brand', 'Brand', 'Nike, Zara, H&M'),
                self::select('size', 'Size', ['XS', 'S', 'M', 'L', 'XL', 'XXL']),
                self::select('condition', 'Condition', ['New with Tags', 'Like New', 'Used']),
                self::text('color', 'Color', 'Black'),
            ],
            'home-garden' => [
                self::text('brand', 'Brand', 'IKEA, Bosch, Philips'),
                self::select('condition', 'Condition', ['New', 'Like New', 'Used']),
                self::text('material', 'Material', 'Wood, Steel, Fabric'),
                self::boolean('delivery_available', 'Delivery Available'),
            ],
            'sports' => [
                self::text('brand', 'Brand', 'Adidas, Decathlon, Wilson'),
                self::select('condition', 'Condition', ['New', 'Like New', 'Used']),
                self::select('age_group', 'Age Group', ['Kids', 'Teen', 'Adult']),
                self::text('sport_level', 'Skill Level', 'Beginner, Intermediate'),
            ],
            'jobs' => [
                self::text('company_name', 'Company Name', 'OpenClassify'),
                self::select('experience_level', 'Experience Level', ['Entry', 'Mid', 'Senior', 'Lead']),
                self::boolean('remote', 'Remote'),
                self::date('start_date', 'Start Date'),
            ],
            'services' => [
                self::text('provider_name', 'Provider Name', 'Company or individual name'),
                self::text('response_time', 'Response Time', 'Within 2 hours'),
                self::boolean('on_site', 'On Site Service'),
                self::select('pricing_model', 'Pricing Model', ['Fixed', 'Hourly', 'Per Project']),
            ],
            default => [],
        };
    }

    private static function categoryDefinitions(string $categorySlug): array
    {
        return match ($categorySlug) {
            'electronics-phones' => [
                self::number('storage_gb', 'Storage (GB)', '128'),
                self::number('battery_health', 'Battery Health (%)', '92'),
                self::text('color', 'Color', 'Midnight Black'),
            ],
            'electronics-computers' => [
                self::text('processor', 'Processor', 'Apple M2, Intel i7'),
                self::number('ram_gb', 'RAM (GB)', '16'),
                self::number('storage_gb', 'Storage (GB)', '512'),
            ],
            'electronics-tablets' => [
                self::number('screen_size_inch', 'Screen Size (inch)', '11'),
                self::number('storage_gb', 'Storage (GB)', '256'),
                self::select('connectivity', 'Connectivity', ['Wi-Fi', 'Wi-Fi + Cellular']),
            ],
            'electronics-tvs' => [
                self::number('screen_size_inch', 'Screen Size (inch)', '55'),
                self::select('resolution', 'Resolution', ['HD', 'Full HD', '4K', '8K']),
                self::boolean('smart_tv', 'Smart TV'),
            ],
            'vehicles-cars' => [
                self::number('mileage_km', 'Mileage (km)', '85000'),
                self::select('transmission', 'Transmission', ['Manual', 'Automatic', 'Semi Automatic']),
                self::select('fuel_type', 'Fuel Type', ['Gasoline', 'Diesel', 'Hybrid', 'Electric', 'LPG']),
            ],
            'vehicles-motorcycles' => [
                self::number('engine_cc', 'Engine (cc)', '650'),
                self::number('mileage_km', 'Mileage (km)', '24000'),
                self::select('fuel_type', 'Fuel Type', ['Gasoline', 'Electric']),
            ],
            'vehicles-trucks' => [
                self::number('mileage_km', 'Mileage (km)', '120000'),
                self::number('payload_kg', 'Payload (kg)', '3500'),
                self::number('axle_count', 'Axle Count', '2'),
            ],
            'vehicles-boats' => [
                self::number('length_ft', 'Length (ft)', '24'),
                self::number('engine_hours', 'Engine Hours', '430'),
                self::text('hull_material', 'Hull Material', 'Fiberglass'),
            ],
            'real-estate-for-sale' => [
                self::number('bedrooms', 'Bedrooms', '3'),
                self::number('bathrooms', 'Bathrooms', '2'),
                self::boolean('title_deed_ready', 'Title Deed Ready'),
            ],
            'real-estate-for-rent' => [
                self::number('bedrooms', 'Bedrooms', '2'),
                self::number('bathrooms', 'Bathrooms', '1'),
                self::number('deposit_amount', 'Deposit Amount', '25000'),
            ],
            'real-estate-commercial' => [
                self::select('property_use', 'Property Use', ['Office', 'Shop', 'Warehouse', 'Workshop']),
                self::number('parking_spaces', 'Parking Spaces', '3'),
                self::text('heating', 'Heating', 'Central, VRF'),
            ],
            'fashion-men', 'fashion-women', 'fashion-kids' => [
                self::text('material', 'Material', 'Cotton'),
                self::select('season', 'Season', ['Spring', 'Summer', 'Autumn', 'Winter']),
                self::boolean('original_packaging', 'Original Packaging'),
            ],
            'fashion-shoes' => [
                self::number('eu_size', 'EU Size', '42'),
                self::text('material', 'Material', 'Leather'),
                self::boolean('box_included', 'Box Included'),
            ],
            'home-garden-furniture' => [
                self::number('width_cm', 'Width (cm)', '180'),
                self::number('height_cm', 'Height (cm)', '85'),
                self::boolean('assembly_required', 'Assembly Required'),
            ],
            'home-garden-garden' => [
                self::select('power_source', 'Power Source', ['Manual', 'Electric', 'Battery', 'Fuel']),
                self::number('usage_area_sqm', 'Usage Area (sqm)', '450'),
                self::boolean('included_tools', 'Included Tools'),
            ],
            'home-garden-appliances' => [
                self::select('energy_rating', 'Energy Rating', ['A', 'A+', 'A++', 'A+++', 'B', 'C']),
                self::boolean('installation_available', 'Installation Available'),
                self::boolean('warranty_available', 'Warranty Available'),
            ],
            'sports-outdoor' => [
                self::select('activity_type', 'Activity Type', ['Camping', 'Hiking', 'Cycling', 'Fishing']),
                self::number('weight_kg', 'Weight (kg)', '12'),
                self::boolean('waterproof', 'Waterproof'),
            ],
            'sports-fitness' => [
                self::text('equipment_type', 'Equipment Type', 'Treadmill, Bench'),
                self::number('max_weight_kg', 'Max Weight (kg)', '150'),
                self::boolean('foldable', 'Foldable'),
            ],
            'sports-team-sports' => [
                self::select('sport_type', 'Sport Type', ['Football', 'Basketball', 'Volleyball', 'Handball']),
                self::select('official_size', 'Official Size', ['Yes', 'No']),
                self::boolean('team_set_included', 'Team Set Included'),
            ],
            'jobs-full-time' => [
                self::number('salary_monthly', 'Monthly Salary', '60000'),
                self::select('contract_type', 'Contract Type', ['Permanent', 'Contract']),
                self::textarea('benefits', 'Benefits', 'Health insurance, meal card, bonus'),
            ],
            'jobs-part-time' => [
                self::number('hourly_rate', 'Hourly Rate', '350'),
                self::number('weekly_hours', 'Weekly Hours', '24'),
                self::text('schedule', 'Schedule', 'Weekday evenings'),
            ],
            'jobs-freelance' => [
                self::text('project_length', 'Project Length', '3 months'),
                self::number('budget', 'Project Budget', '45000'),
                self::text('payment_terms', 'Payment Terms', '50% upfront, 50% on delivery'),
            ],
            'services-cleaning' => [
                self::select('service_scope', 'Service Scope', ['Home', 'Office', 'Move-out', 'Deep Cleaning']),
                self::boolean('eco_friendly', 'Eco Friendly Products'),
                self::boolean('same_day_available', 'Same Day Available'),
            ],
            'services-repair' => [
                self::text('repair_type', 'Repair Type', 'Phone, appliance, AC'),
                self::boolean('emergency_service', 'Emergency Service'),
                self::number('warranty_days', 'Warranty (days)', '90'),
            ],
            'services-education' => [
                self::text('subject', 'Subject', 'Math, English, Coding'),
                self::select('delivery_mode', 'Delivery Mode', ['Online', 'In Person', 'Hybrid']),
                self::number('lesson_duration_minutes', 'Lesson Duration (minutes)', '60'),
            ],
            default => [],
        };
    }

    private static function text(string $name, string $label, ?string $placeholder = null): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_TEXT,
            'placeholder' => $placeholder,
        ];
    }

    private static function textarea(string $name, string $label, ?string $placeholder = null): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_TEXTAREA,
            'placeholder' => $placeholder,
        ];
    }

    private static function number(string $name, string $label, ?string $placeholder = null): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_NUMBER,
            'placeholder' => $placeholder,
        ];
    }

    private static function select(string $name, string $label, array $options): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_SELECT,
            'options' => $options,
        ];
    }

    private static function boolean(string $name, string $label): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_BOOLEAN,
        ];
    }

    private static function date(string $name, string $label): array
    {
        return [
            'name' => $name,
            'label' => $label,
            'type' => ListingCustomField::TYPE_DATE,
        ];
    }
}
