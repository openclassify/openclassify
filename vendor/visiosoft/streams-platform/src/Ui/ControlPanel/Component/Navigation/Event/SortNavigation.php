<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SortNavigation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SortNavigation
{

    /**
     * The control panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new SortNavigation instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the control panel builder.
     *
     * @return ControlPanelBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
