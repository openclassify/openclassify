<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class TablePagination
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TablePagination
{

    /**
     * Return table pagination data.
     *
     * @param  Table $table
     * @return array
     */
    public function make(Table $table)
    {
        $options = $table->getOptions();

        $perPage   = $options->get('limit') ?: config('streams::system.per_page');
        $pageName  = $table->getOption('prefix') . 'page';
        $page      = app('request')->get($pageName);
        $path      = '/' . app('request')->path();
        $paginator = new LengthAwarePaginator(
            $table->getEntries(),
            $options->get('total_results', 0),
            $perPage,
            $page,
            compact('path', 'pageName')
        );

        $pagination          = $paginator->toArray();
        $pagination['links'] = $paginator->appends(app('request')->all())->render();

        return $pagination;
    }
}
