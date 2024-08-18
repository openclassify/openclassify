<?php namespace Visiosoft\CommentsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class CommentsModule extends Module
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
    protected $icon = 'fa fa-commenting-o';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'comments' => [
            'buttons' => [
                'new_comment',
            ],
        ],
    ];

}
