<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button;

use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

class ButtonLookup
{

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * Create a new ButtonLookup instance.
     *
     * @param ButtonRegistry $buttons
     */
    public function __construct(ButtonRegistry $buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * Merge in registered properties.
     *
     * @param ControlPanelBuilder $builder
     */
    public function merge(ControlPanelBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as &$parameters) {
            if (!$button = array_get($parameters, 'button')) {
                continue;
            }

            if ($button && $button = $this->buttons->get($button)) {
                $parameters = array_replace_recursive($button, $parameters);
            }

            $button = array_get($parameters, 'button', $button);

            if ($button && $button = $this->buttons->get($button)) {
                $parameters = array_replace_recursive($button, $parameters);
            }
        }

        $builder->setButtons($buttons);
    }
}
