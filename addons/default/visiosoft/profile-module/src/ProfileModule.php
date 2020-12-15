<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class ProfileModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-user';

    /**
     * The module sections.
     *
     * @var array
     */
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
