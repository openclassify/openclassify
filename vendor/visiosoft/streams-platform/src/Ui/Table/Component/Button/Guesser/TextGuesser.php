<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

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
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new TextGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Guess the text for a button.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $buttons = $builder->getButtons();

        if (!$module = $this->modules->active()) {
            return;
        }

        foreach ($buttons as &$button) {

            // Skip if set already.
            if (!isset($button['text']) && isset($button['slug'])) {
                $button['text'] = $module->getNamespace('button.' . $button['slug']);
            }
        }

        $builder->setButtons($buttons);
    }
}
