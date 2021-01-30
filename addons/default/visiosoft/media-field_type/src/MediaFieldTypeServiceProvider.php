<?php namespace Visiosoft\MediaFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class MediaFieldTypeServiceProvider
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class MediaFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/media-field_type/index/{key}'     => 'Visiosoft\MediaFieldType\Http\Controller\FilesController@index',
        'streams/media-field_type/choose/{key}'    => 'Visiosoft\MediaFieldType\Http\Controller\FilesController@choose',
        'streams/media-field_type/selected'        => 'Visiosoft\MediaFieldType\Http\Controller\FilesController@selected',
        'streams/media-field_type/exists/{folder}' => 'Visiosoft\MediaFieldType\Http\Controller\FilesController@exists',
        'streams/media-field_type/upload/{folder}' => 'Visiosoft\MediaFieldType\Http\Controller\UploadController@index',
        'streams/media-field_type/handle'          => 'Visiosoft\MediaFieldType\Http\Controller\UploadController@upload',
        'streams/media-field_type/recent'          => 'Visiosoft\MediaFieldType\Http\Controller\UploadController@recent',
        'image/rotate'          => 'Visiosoft\MediaFieldType\Http\Controller\UploadController@rotate',
    ];
}
