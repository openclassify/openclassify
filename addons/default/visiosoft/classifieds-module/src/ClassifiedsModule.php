<?php namespace Visiosoft\ClassifiedsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class ClassifiedsModule extends Module
{
    protected $navigation = true;

    protected $icon = 'fa fa-plus-circle';

    protected $sections = [
        'classifieds' => [
            'buttons' => [
                'new_classified' => [
                     'href' => "/classifieds/create_classified",
                ],
                'new_classified' => [
                    'text' => 'visiosoft.module.classifieds::button.fast_create'
                ],
                'extend_all' => [
                    'href' => "/classifieds/extendAll/admin",
                    'icon' => 'fa fa-calendar',
                    'type' => 'info'
                ],
            ],
        ],
	    'status' => [
		    'buttons' => [
			    'new_status',
		    ],
	    ],
	    'product_options' => [
		    'title' => 'visiosoft.module.classifieds::section.product_options.title',
		    'buttons' => [
			    'new_productoption',
		    ],
	    ],
	    'productoptions_value' => [
		    'title' => 'visiosoft.module.classifieds::section.productoptions_value.title',
		    'buttons' => [
			    'new_productoptions_value',
		    ],
	    ],
	    'option_configuration',
        'assets_clear' => [
	        'title' => 'visiosoft.module.classifieds::section.assets_clear.name',
	        'href' => '/admin/assets/clear',
        ]
    ];

}
