<?php namespace Anomaly\FilesFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class FilesFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilesFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/files-field_type/index/{key}'           => 'Anomaly\FilesFieldType\Http\Controller\FilesController@index',
        'streams/files-field_type/choose/{key}'          => 'Anomaly\FilesFieldType\Http\Controller\FilesController@choose',
        'streams/files-field_type/selected'              => 'Anomaly\FilesFieldType\Http\Controller\FilesController@selected',
        'streams/files-field_type/exists/{folder}'       => 'Anomaly\FilesFieldType\Http\Controller\FilesController@exists',
        'streams/files-field_type/upload/{folder}/{key}' => 'Anomaly\FilesFieldType\Http\Controller\UploadController@index',
        'streams/files-field_type/handle'                => 'Anomaly\FilesFieldType\Http\Controller\UploadController@upload',
        'streams/files-field_type/recent'                => 'Anomaly\FilesFieldType\Http\Controller\UploadController@recent',
    ];
}
