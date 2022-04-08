<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class TypeGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TypeGuesser
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new TypeGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules    = $modules;
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

            /*
             * If the button starts with "new_" just use
             * "new" and move the rest to the text.
             */
            if (isset($button['button']) && starts_with($button['button'], 'new_')) {
                if (!isset($button['text'])) {

                    $text = $module->getNamespace('button.' . $button['button']);

                    if (trans()->has($text)) {
                        $button['text'] = $text;
                    }
                }

                // Change this to slug for later.
                $button['slug'] = $button['button'];

                array_set($button, 'button', substr($button['button'], 0, 3));
            }

            /*
             * If the button starts with "add_" just use
             * "add" and move the rest to the text.
             */
            if (isset($button['button']) && starts_with($button['button'], 'add_')) {
                if (!isset($button['text'])) {
                    $button['text'] = $module->getNamespace('button.' . $button['button']);
                }

                // Change this to slug for later.
                $button['slug'] = $button['button'];

                array_set($button, 'button', substr($button['button'], 0, 3));
            }
        }

        $builder->setButtons($buttons);
    }
}
