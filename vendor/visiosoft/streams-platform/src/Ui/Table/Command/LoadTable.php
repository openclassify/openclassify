<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadTable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadTable
{
    use DispatchesJobs;

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new LoadTable instance.
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
     * @param Container            $container
     * @param ViewTemplate         $template
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Container $container, ViewTemplate $template, BreadcrumbCollection $breadcrumbs)
    {
        $table = $this->builder->getTable();

        $table->addData('table', $table);

        if ($handler = $table->getOption('data')) {
            $container->call($handler, compact('table'));
        }

        if ($layout = $table->getOption('layout_view')) {
            $template->put('layout', $layout);
        }

        if ($title = $table->getOption('title')) {
            $template->put('title', $title);
        }

        $this->dispatchNow(new LoadTablePagination($table));

        if ($breadcrumb = $table->getOption('breadcrumb')) {
            $breadcrumbs->put($breadcrumb, '#');
        }
    }
}
