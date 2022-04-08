<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Http\Request;

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
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ModuleCollection $modules
     * @param ThemeCollection $themes
     * @param Request $request
     */
    public function handle(ModuleCollection $modules, ThemeCollection $themes, Request $request)
    {
        $theme = $themes->current();

        $table = $this->builder->getTable();

        /*
         * Set the default sortable option.
         */
        if ($table->getOption('sortable') === null) {
            $stream = $table->getStream();

            if ($stream && $stream->isSortable()) {
                $table->setOption('sortable', true);
            }
        }

        /*
         * Default the table view based on the request.
         */
        if (!$this->builder->getTableOption('table_view') && $this->builder->isAjax()) {
            $this->builder->setTableOption('table_view', 'streams::table/ajax');
        }

        if (!$this->builder->getTableOption('table_view') && $theme && $theme->isAdmin()) {
            $this->builder->setTableOption('table_view', 'streams::table/table');
        }

        if (!$this->builder->getTableOption('table_view') && $theme && !$theme->isAdmin()) {
            $this->builder->setTableOption('table_view', 'streams::table/standard');
        }

        if (!$this->builder->getTableOption('table_view')) {
            $this->builder->setTableOption('table_view', 'streams::table/table');
        }

        /*
         * Sortable tables have no pages.
         */
        if ($table->getOption('sortable') === true) {
            $table->setOption('limit', $table->getOption('limit', 99999));
        }

        /*
         * Set the default breadcrumb.
         */
        if ($table->getOption('breadcrumb') === null && $title = $table->getOption('title')) {
            $table->setOption('breadcrumb', $title);
        }

        /*
         * If the table ordering is currently being overridden
         * then set the values from the request on the builder
         * last so it actually has an effect.
         */
        if ($orderBy = $this->builder->getRequestValue('order_by')) {
            $table->setOption('order_by', [$orderBy => $this->builder->getRequestValue('sort', 'asc')]);
        }

        /*
         * If the table limit is currently being overridden
         * then set the values from the request on the builder
         * last so it actually has an effect. Otherwise default.
         */
        if ($table->getOption('limit') === null) {
            $table->setOption(
                'limit',
                $this->builder->getRequestValue('limit', config('streams::system.per_page', 15))
            );
        }

        /*
         * If the permission is not set then
         * try and automate it.
         */
        if (
            $table->getOption('permission') === null &&
            $request->segment(1) == 'admin' &&
            ($module = $modules->active()) &&
            ($stream = $this->builder->getTableStream())
        ) {
            $table->setOption('permission', $module->getNamespace($stream->getSlug() . '.read'));
        }
    }
}
