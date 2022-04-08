<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Command;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\ButtonBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class BuildButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildButtons
{

    /**
     * The control_panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new BuildButtons instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ButtonBuilder $builder
     */
    public function handle(ButtonBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
