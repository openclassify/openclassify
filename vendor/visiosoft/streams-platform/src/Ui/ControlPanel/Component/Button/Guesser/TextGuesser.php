<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class TextGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TextGuesser
{

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new TextGuesser instance.
     *
     * @param ButtonRegistry $buttons
     * @param ModuleCollection $modules
     */
    public function __construct(
        ButtonRegistry $buttons,
        ModuleCollection $modules
    ) {
        $this->buttons = $buttons;
        $this->modules = $modules;
    }

    /**
     * Guess the button from the hint.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $buttons = $builder->getButtons();

        $module = $this->modules->active();

        /*
         * This will break if we can't figure
         * out what the active module is.
         */
        if (!$module instanceof Module) {
            return;
        }

        foreach ($buttons as &$button) {
            if (isset($button['text'])) {
                continue;
            }

            if (!isset($button['button'])) {
                continue;
            }

            $text = $module->getNamespace('button.' . $button['button']);

            if (!isset($button['text']) && trans()->has($text)) {
                $button['text'] = $text;
            }

            if (
                (!isset($button['text']) || !trans()->has($button['text']))
                && config('streams::system.lazy_translations')
            ) {
                $button['text'] = ucwords(humanize(array_get($button, 'slug', $button['button'])));
            }

            if (!isset($button['text'])) {
                $button['text'] = $text;
            }
        }

        $builder->setButtons($buttons);
    }
}
