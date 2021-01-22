<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class AdvsModule extends Module
{
    protected $navigation = true;

    protected $icon = 'fa fa-plus-circle';

    protected $sections = [
        'advs' => [
            'buttons' => [
                'new_classified' => [
                     'href' => "/advs/create_adv",
                ],
                'new_adv' => [
                    'text' => 'visiosoft.module.advs::button.fast_create'
                ],
                'extend_all' => [
                    'href' => "/advs/extendAll/admin",
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
		    'title' => 'visiosoft.module.advs::section.product_options.title',
		    'buttons' => [
			    'new_productoption',
		    ],
	    ],
	    'productoptions_value' => [
		    'title' => 'visiosoft.module.advs::section.productoptions_value.title',
		    'buttons' => [
			    'new_productoptions_value',
		    ],
	    ],
	    'option_configuration',
        'assets_clear' => [
	        'title' => 'visiosoft.module.advs::section.assets_clear.name',
	        'href' => '/admin/assets/clear',
        ]
    ];

}
