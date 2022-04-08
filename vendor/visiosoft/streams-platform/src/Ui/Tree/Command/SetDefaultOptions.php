<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Entry\EntryTreeRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentTreeRepository;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

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
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $tree = $this->builder->getTree();

        /*
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$tree->getOption('options')) {
            $options = str_replace('TreeBuilder', 'TreeOptions', get_class($this->builder));

            if (class_exists($options)) {
                app()->call($options . '@handle', compact('builder', 'tree'));
            }
        }

        /*
         * Set the default data handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$tree->getOption('data')) {
            $options = str_replace('TreeBuilder', 'TreeData', get_class($this->builder));

            if (class_exists($options)) {
                $tree->setOption('data', $options . '@handle');
            }
        }

        /*
         * Set a optional entries handler based
         * on the builder class. Defaulting to
         * no handler in which case we will use
         * the model and included repositories.
         */
        if (!$tree->getOption('entries')) {
            $entries = str_replace('TreeBuilder', 'TreeEntries', get_class($this->builder));

            if (class_exists($entries)) {
                $tree->setOption('entries', $entries . '@handle');
            }
        }

        /*
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$tree->getOption('repository')) {
            $model = $tree->getModel();

            if (!$tree->getOption('repository') && $model instanceof EntryModel) {
                $tree->setOption('repository', EntryTreeRepository::class);
            }

            if (!$tree->getOption('repository') && $model instanceof EloquentModel) {
                $tree->setOption('repository', EloquentTreeRepository::class);
            }
        }
    }
}
