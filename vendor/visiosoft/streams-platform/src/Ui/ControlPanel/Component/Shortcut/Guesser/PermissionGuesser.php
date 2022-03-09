<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class PermissionGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PermissionGuesser
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new TitleGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Guess the shortcuts title.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        if (!$module = $this->modules->active()) {
            return;
        }

        $shortcuts = $builder->getShortcuts();

        foreach ($shortcuts as &$shortcut) {

            // If permission is set then skip it.
            if (isset($shortcut['permission'])) {
                continue;
            }

            $shortcut['permission'] = $module->getNamespace($shortcut['slug'] . '.*');
        }

        $builder->setShortcuts($shortcuts);
    }
}
