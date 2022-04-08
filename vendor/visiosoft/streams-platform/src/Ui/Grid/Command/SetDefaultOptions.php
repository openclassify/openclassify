<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Entry\EntryGridRepository;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentGridRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class SetDefaultOptions
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetDefaultOptions
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param GridBuilder $builder
     */
    public function __construct(GridBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $grid = $this->builder->getGrid();

        /*
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$grid->getOption('options')) {
            $options = str_replace('GridBuilder', 'GridOptions', get_class($this->builder));

            if (class_exists($options)) {
                app()->call($options . '@handle', compact('builder', 'grid'));
            }
        }

        /*
         * Set the default data handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$grid->getOption('data')) {
            $options = str_replace('GridBuilder', 'GridData', get_class($this->builder));

            if (class_exists($options)) {
                $grid->setOption('data', $options . '@handle');
            }
        }

        /*
         * Set a optional entries handler based
         * on the builder class. Defaulting to
         * no handler in which case we will use
         * the model and included repositories.
         */
        if (!$grid->getOption('entries')) {
            $entries = str_replace('GridBuilder', 'GridEntries', get_class($this->builder));

            if (class_exists($entries)) {
                $grid->setOption('entries', $entries . '@handle');
            }
        }

        /*
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$grid->getOption('repository')) {
            $model = $grid->getModel();

            if (!$grid->getOption('repository') && $model instanceof EntryModel) {
                $grid->setOption('repository', EntryGridRepository::class);
            }

            if (!$grid->getOption('repository') && $model instanceof EloquentModel) {
                $grid->setOption('repository', EloquentGridRepository::class);
            }
        }
    }
}
