<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Command;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\ShortcutBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class BuildShortcuts
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildShortcuts
{

    /**
     * The control_panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new BuildShortcuts instance.
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
     * @param ShortcutBuilder $builder
     */
    public function handle(ShortcutBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
