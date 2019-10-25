<?php namespace Visiosoft\AdvsModule\Seed;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksBlocksEntryModel;
use Anomaly\Streams\Platform\Model\HtmlBlock\HtmlBlockBlocksEntryModel;
use Illuminate\Support\Facades\DB;

class BlockSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {

        DB::table('blocks_areas')
            ->where('slug', 'left-home-banner-area')
            ->orWhere('slug', 'middle-home-banner-area')
            ->orWhere('slug', 'right-home-banner-area')
            ->orWhere('slug', 'list-item-right-sidebar')
            ->orWhere('slug', 'center-add-ad-banner-area')
            ->orWhere('slug', 'profile-right-sidebar')
            ->delete();

        // Add Ad Center Banner Area
        $center_add_ad_banner_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Center Add Ad Banner Area',
            ],
            'tr' => [
                'name' => 'İlan Ver Orta Reklam Alanı',
            ],
            'slug' => 'center-add-ad-banner-area',
        ]);

        $center_add_ad_banner_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/middle-home-banner-area.twig'),
            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/middle-home-banner-area.twig'),
            ],
        ]);

        BlocksBlocksEntryModel::create([
            'area_id' => $center_add_ad_banner_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $center_add_ad_banner_html->id,
        ]);

        // left Home Banner Area
        $left_home_banner_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Left Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Sol reklam alanı',
            ],
            'slug' => 'left-home-banner-area',
        ]);

        $left_home_banner_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/left-home-banner-area.twig'),
            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/left-home-banner-area.twig'),
            ],
        ]);

        BlocksBlocksEntryModel::create([
            'area_id' => $left_home_banner_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $left_home_banner_html->id,
        ]);

        // middle Home Banner Area
        $middle_home_banner_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Middle Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Orta reklam alanı',
            ],
            'slug' => 'middle-home-banner-area',
        ]);

        $middle_home_banner_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/middle-home-banner-area.twig'),
            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/middle-home-banner-area.twig'),
            ],
        ]);
        BlocksBlocksEntryModel::create([
            'area_id' => $middle_home_banner_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $middle_home_banner_html->id,
        ]);

        // right Home Banner Area
        $right_home_banner_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Right Home Banner Area',
            ],
            'tr' => [
                'name' => 'Anasayfa Sağ reklam alanı',
            ],
            'slug' => 'right-home-banner-area',
        ]);

        $right_home_banner_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/right-home-banner-area.twig'),

            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/right-home-banner-area.twig'),

            ],
        ]);

        BlocksBlocksEntryModel::create([
            'area_id' => $right_home_banner_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $right_home_banner_html->id,
        ]);

        // List item Right Sidebar
        $list_item_right_sidebar_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'List item Right Sidebar',
            ],
            'tr' => [
                'name' => 'ilan Detay Sağ Alan',
            ],
            'slug' => 'list-item-right-sidebar',
        ]);

        $list_item_right_sidebar_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/list-item-right-sidebar-en.twig'),
            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/list-item-right-sidebar-tr.twig'),
            ],
        ]);
        BlocksBlocksEntryModel::create([
            'area_id' => $list_item_right_sidebar_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $list_item_right_sidebar_html->id,
        ]);

        // Profile Right Sidebar

        $profile_right_sidebar_area = BlocksAreasEntryModel::create([
            'en' => [
                'name' => 'Profile Right Sidebar',
            ],
            'tr' => [
                'name' => 'Profil Sağ Alan',
            ],
            'slug' => 'profile-right-sidebar',
        ]);

        $profile_right_sidebar_html = HtmlBlockBlocksEntryModel::create([
            'en' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/list-item-right-sidebar-en.twig'),
            ],
            'tr' => [
                'html' => file_get_contents(__DIR__ . '/Blocks/list-item-right-sidebar-tr.twig'),
            ],
        ]);
        BlocksBlocksEntryModel::create([
            'area_id' => $profile_right_sidebar_area->id,
            'area_type' => 'Anomaly\BlocksModule\Area\AreaModel',
            'field_id' => 52,
            'extension' => 'anomaly.extension.html_block',
            'display_title' => 0,
            'entry_type' => 'Anomaly\HtmlBlockExtension\Block\BlockModel',
            'entry_id' => $profile_right_sidebar_html->id,
        ]);

    }
}
