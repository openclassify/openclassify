<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksAreasEntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksBlocksEntryModel;
use Anomaly\Streams\Platform\Model\HtmlBlock\HtmlBlockBlocksEntryModel;
use Illuminate\Support\Facades\DB;

class VisiosoftModuleLocationCreateLocationFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '_'
            ],
        ],
        'parent_country' => [
            'type' => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CountryModel::class,
                "default_value" => 0,
            ]
        ],
        'parent_country_id' => 'anomaly.field_type.integer',
        'parent_city_id' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'parent_district_id' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'parent_neighborhood_id' => [
            "type" => "anomaly.field_type.select",
            "config" => [
                "options" => [],
            ]
        ],
        'order' => 'anomaly.field_type.integer',
    ];
}
