<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class PlaceholdersGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PlaceholdersGuesser
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new PlaceholdersGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Guess some table table filter placeholders.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $filters = $builder->getFilters();
        $stream  = $builder->getTableStream();

        foreach ($filters as &$filter) {

            // Skip if we already have a placeholder.
            if (isset($filter['placeholder'])) {
                continue;
            }

            // Get the placeholder off the assignment.
            if ($stream && $assignment = $stream->getAssignment(array_get($filter, 'field'))) {

                /*
                 * Always use the field name
                 * as the placeholder. Placeholders
                 * that are assigned otherwise usually
                 * feel out of context:
                 *
                 * "Choose an option..." in the filter
                 * would just be weird.
                 */
                $placeholder = $assignment->getFieldName();

                if (trans()->has($placeholder)) {
                    $filter['placeholder'] = $placeholder;
                }
            }

            if (!$module = $this->modules->active()) {
                continue;
            }

            $placeholder = $module->getNamespace('field.' . $filter['slug'] . '.placeholder');

            if (!isset($filter['placeholder']) && trans()->has($placeholder)) {
                $filter['placeholder'] = $placeholder;
            }

            $placeholder = $module->getNamespace('field.' . $filter['slug'] . '.name');

            if (!isset($filter['placeholder']) && trans()->has($placeholder)) {
                $filter['placeholder'] = $placeholder;
            }

            if (!array_get($filter, 'placeholder')) {
                $filter['placeholder'] = $filter['slug'];
            }

            if (
                !trans()->has($filter['placeholder'])
                && config('streams::system.lazy_translations')
            ) {
                $filter['placeholder'] = ucwords(humanize($filter['placeholder']));
            }
        }

        $builder->setFilters($filters);
    }
}
