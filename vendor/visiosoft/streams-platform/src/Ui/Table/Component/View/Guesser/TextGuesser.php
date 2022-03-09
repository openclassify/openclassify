<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser;

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
     * Guess the text for the views.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        if (!$module = $this->modules->active()) {
            return;
        }

        $views = $builder->getViews();

        foreach ($views as &$view) {

            // Only automate it if not set.
            if (!isset($view['text'])) {
                $view['text'] = $module->getNamespace('view.' . $view['slug']);
            }
        }

        $builder->setViews($views);
    }
}
