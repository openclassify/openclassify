<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser;

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
     * Guess the action text.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $actions = $builder->getActions();

        if (!$module = $this->modules->active()) {
            return;
        }

        foreach ($actions as &$action) {

            // Only if it's not already set.
            if (!isset($action['text'])) {
                $action['text'] = $module->getNamespace('button.' . $action['slug']);
            }
        }

        $builder->setActions($actions);
    }
}
