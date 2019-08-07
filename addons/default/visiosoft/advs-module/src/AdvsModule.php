<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class AdvsModule extends Module
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
    protected $icon = 'fa fa-plus-circle';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'advs' => [
            'buttons' => [
                'new_adv' => [
                     'href' => "/advs/create_adv",
                ],
            ],
        ],
        'assets_clear' => [
            'title' => 'visiosoft.module.advs::section.assets_clear.name',
            'href' => '/admin/assets/clear',
        ]
        // 'custom_fields' => [
        //     'buttons' => [
        //         'new_custom_field',
        //     ],
        // ],
        // 'custom_field_advs' => [
        //     // 'buttons' => [
        //     //     'new_custom_field_adv',
        //     // ],
        // ],
        
    ];

}
