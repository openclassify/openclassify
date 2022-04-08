<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
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
     * Create a new PermissionGuesser instance.
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

        if (!$stream = $builder->getTableStream()) {
            return;
        }

        foreach ($buttons as &$button) {
            if (isset($button['permission'])) {
                continue;
            }

            /*
             * Try and guess the permission value.
             */
            switch (array_get($button, 'button')) {

                case 'edit':
                    $button['permission'] = $module->getNamespace($stream->getSlug() . '.write');
                    break;

                default:
                    $button['permission'] = $module->getNamespace(
                        $stream->getSlug() . '.' . array_get($button, 'slug')
                    );
                    break;
            }
        }

        $builder->setButtons($buttons);
    }
}
