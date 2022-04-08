<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeadingsGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HeadingsGuesser
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new HeadingsGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Guess the field for a column.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $columns = $builder->getColumns();
        $stream  = $builder->getTableStream();

        $module = $this->modules->active();

        foreach ($columns as &$column) {

            /*
             * If the heading is already set then
             * we don't have anything to do.
             */
            if (isset($column['heading'])) {
                continue;
            }

            /*
             * If the heading is false, then no
             * header is desired at all.
             */
            if (isset($column['heading']) && $column['heading'] === false) {
                continue;
            }

            /*
             * No stream means we can't
             * really do much here.
             */
            if (!$stream instanceof StreamInterface) {
                continue;
            }

            if (!isset($column['field']) && is_string($column['value'])) {
                $column['field'] = $column['value'];
            }

            /*
             * If the heading matches a field
             * with dot format then reduce it.
             */
            if (isset($column['field']) && preg_match("/^entry.([a-zA-Z\\_]+)/", $column['field'], $match)) {
                $column['field'] = $match[1];
            }

            /*
             * Detect some built in columns.
             */
            if (in_array($column['field'], ['id', 'created_at', 'created_by', 'updated_at', 'updated_by'])) {

                $column['heading']     = 'streams::entry.' . $column['field'];
                $column['sort_column'] = str_replace('_by', '_by_id', $column['field']);

                continue;
            }

            /*
             * Detect entry title.
             */
            if (in_array($column['field'], ['view_link', 'edit_link']) && $field = $stream->getTitleField()) {
                $column['heading'] = $field->getName();

                continue;
            }

            $field = $stream->getField(array_get($column, 'field'));

            /*
             * Detect the title column.
             */
            $title = $stream->getTitleField();

            if (
                $title &&
                !$field &&
                $column['field'] == 'title' &&
                trans()->has($heading = $title->getName())
            ) {
                $column['heading'] = $heading;
            }

            /*
             * Use the name from the field.
             */
            if ($field && $heading = $field->getName()) {
                $column['heading'] = $heading;
            }

            /*
             * If no field look for
             * a name anyways.
             */
            if ($module && !$field && trans()->has(
                    $heading = $module->getNamespace('field.' . $column['field'] . '.name')
                )
            ) {
                $column['heading'] = $heading;
            }

            /*
             * If no translatable heading yet and
             * the heading matches the value (default)
             * then humanize the heading value.
             */
            if (!isset($column['heading']) && config('streams::system.lazy_translations')) {
                $column['heading'] = ucwords(humanize($column['field']));
            }

            /*
             * If we have a translatable heading and
             * the heading does not have a translation
             * then humanize the heading value.
             */
            if (
                isset($column['heading']) &&
                str_is('*.*.*::*', $column['heading']) &&
                !trans()->has($column['heading']) &&
                config('streams::system.lazy_translations')
            ) {
                $column['heading'] = ucwords(humanize($column['field']));
            }

            /*
             * Last resort.
             */
            if ($module && !isset($column['heading'])) {
                $column['heading'] = $module->getNamespace('field.' . $column['field'] . '.name');
            }
        }

        $builder->setColumns($columns);
    }
}
