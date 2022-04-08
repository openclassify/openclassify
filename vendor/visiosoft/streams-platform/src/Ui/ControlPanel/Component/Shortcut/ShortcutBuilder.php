<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class ShortcutBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShortcutBuilder
{

    /**
     * The shortcut input.
     *
     * @var ShortcutInput
     */
    protected $input;

    /**
     * The shortcut factory.
     *
     * @var ShortcutFactory
     */
    protected $factory;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new ShortcutBuilder instance.
     *
     * @param ShortcutInput   $input
     * @param ShortcutFactory $factory
     * @param Authorizer     $authorizer
     */
    public function __construct(ShortcutInput $input, ShortcutFactory $factory, Authorizer $authorizer)
    {
        $this->input      = $input;
        $this->factory    = $factory;
        $this->authorizer = $authorizer;
    }

    /**
     * Build the shortcuts and push them to the control_panel.
     *
     * @param ControlPanelBuilder $builder
     */
    public function build(ControlPanelBuilder $builder)
    {
        $controlPanel = $builder->getControlPanel();

        $this->input->read($builder);

        foreach ($builder->getShortcuts() as $shortcut) {

            if (!$this->authorizer->authorize(array_get($shortcut, 'permission'))) {
                continue;
            }

            $controlPanel->addShortcut($this->factory->make($shortcut));
        }
    }
}
