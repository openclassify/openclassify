<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class ProfileModule extends Module
{
    protected $navigation = true;

    protected $icon = 'fa fa-user';

    protected $sections = [
        'adress' => [
            'buttons' => [
                'new_adress',
            ],
        ],
	    'education' => [
	    	'buttons' => [
	    		'new_education',
		    ]
	    ],
	    'education_part' => [
		    'buttons' => [
			    'new_education_part',
		    ]
	    ],
    ];
}
