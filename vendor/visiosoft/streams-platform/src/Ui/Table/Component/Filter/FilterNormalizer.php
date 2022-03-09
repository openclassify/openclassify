<?php

namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Illuminate\Support\Str;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FilterNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilterNormalizer
{

    /**
     * Core attributes.
     *
     * @var array
     */
    protected $core = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Normalize filter input.
     *
     * @param TableBuilder $builder
     */
    public function normalize(TableBuilder $builder)
    {
        $filters = $builder->getFilters();
        $stream  = $builder->getTableStream();
        $prefix  = $builder->getTableOption('prefix');

        foreach ($filters as $slug => &$filter) {

            /*
             * If the filter is a string and is
             * not core then use it for everything.
             */
            if (is_string($filter) && !Str::contains($filter, '/') && !$this->isCoreAttribute($filter)) {
                $filter = [
                    'slug'   => $filter,
                    'field'  => $filter,
                    'filter' => 'field',
                ];
            }

            /*
             * If the filter is a string and
             * core then use it for everything.
             */
            if (is_string($filter) && !Str::contains($filter, '/') && $this->isCoreAttribute($filter)) {
                $filter = [
                    'slug'   => $filter,
                    'field'  => $filter,
                    'filter' => $filter,
                ];
            }

            /*
             * If the filter is a class string then use
             * it for the filter.
             */
            if (is_string($filter) && Str::contains($filter, '/')) {
                $filter = [
                    'slug'   => $slug,
                    'filter' => $filter,
                ];
            }

            /*
             * Move the slug into the filter.
             */
            if (!isset($filter['slug'])) {
                $filter['slug'] = $slug;
            }

            /*
             * Move the slug to the filter.
             */
            if (!isset($filter['filter'])) {
                $filter['filter'] = $filter['slug'];
            }

            /*
             * Set the prefix if not already set.
             */
            if (!isset($filter['prefix'])) {
                $filter['prefix'] = $prefix;
            }

            /*
             * Fallback the field.
             */
            if (!isset($filter['field']) && $stream && $stream->hasAssignment($filter['slug'])) {
                $filter['field'] = $filter['slug'];
            }

            /*
             * If there is no filter type
             * then assume it's the slug.
             */
            if (!isset($filter['filter'])) {
                $filter['filter'] = $filter['slug'];
            }

            /*
             * Set the table's stream.
             */
            if ($stream) {
                $filter['stream'] = $stream;
            }
        }

        $builder->setFilters($filters);
    }

    /**
     * Return if the field
     * is a core attribute.
     *
     * @param $filter
     * @return bool
     */
    protected function isCoreAttribute($attribute)
    {
        return in_array($attribute, $this->core);
    }
}
