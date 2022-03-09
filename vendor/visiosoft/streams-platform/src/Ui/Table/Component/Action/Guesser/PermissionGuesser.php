<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

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
     * The control panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $controlPanel;

    /**
     * Create a new PermissionGuesser instance.
     *
     * @param ModuleCollection    $modules
     * @param ControlPanelBuilder $controlPanel
     */
    public function __construct(ModuleCollection $modules, ControlPanelBuilder $controlPanel)
    {
        $this->modules      = $modules;
        $this->controlPanel = $controlPanel;
    }

    /**
     * Guess the action text.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $actions = $builder->getActions();
        $stream  = $builder->getTableStream();

        if (!$module = $this->modules->active()) {
            return;
        }

        $section = $this->controlPanel->getControlPanelActiveSection();

        foreach ($actions as &$action) {

            /*
             * Nothing to do if set already.
             */
            if (isset($action['permission'])) {
                continue;
            }

            /*
             * Try and guess the permission.
             */
            if ($stream) {
                $action['permission'] = $module->getNamespace($stream->getSlug() . '.' . $action['slug']);
            } elseif ($section) {
                $action['permission'] = $module->getNamespace($section->getSlug() . '.' . $action['slug']);
            }
        }

        $builder->setActions($actions);
    }
}
