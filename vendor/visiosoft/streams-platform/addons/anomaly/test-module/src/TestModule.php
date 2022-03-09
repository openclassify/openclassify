<?php namespace Anomaly\TestModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class TestModule extends Module
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'addon';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'example'
    ];

}
