<?php namespace Visiosoft\SinglefileFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class SinglefileFieldTypeServiceProvider
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class SinglefileFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        SinglefileFieldTypeModifier::class => SinglefileFieldTypeModifier::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/singlefile-field_type/index/{key}'     => 'Visiosoft\SinglefileFieldType\Http\Controller\FilesController@index',
        'streams/singlefile-field_type/choose/{key}'    => 'Visiosoft\SinglefileFieldType\Http\Controller\FilesController@choose',
        'streams/singlefile-field_type/selected'        => 'Visiosoft\SinglefileFieldType\Http\Controller\FilesController@selected',
        'streams/singlefile-field_type/exists/{folder}' => 'Visiosoft\SinglefileFieldType\Http\Controller\FilesController@exists',
        'streams/singlefile-field_type/upload/{folder}' => 'Visiosoft\SinglefileFieldType\Http\Controller\UploadController@index',
        'streams/singlefile-field_type/handle'          => 'Visiosoft\SinglefileFieldType\Http\Controller\UploadController@upload',
        'streams/singlefile-field_type/recent'          => 'Visiosoft\SinglefileFieldType\Http\Controller\UploadController@recent',
    ];

}
