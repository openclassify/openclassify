<?php namespace Visiosoft\ConnectModule\Resource;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ResourcePagination
 *

 * @package       Visiosoft\ConnectModule\Resource
 */
class ResourcePagination
{

    /**
     * Return resource pagination data.
     *
     * @param ResourceBuilder $builder
     * @return array
     */
    public function make(ResourceBuilder $builder)
    {
        $options = $builder->getResourceOptions();

        $perPage   = $options->get('limit', 15);
        $page      = app('request')->get('page');
        $path      = '/' . app('request')->path();
        $paginator = new LengthAwarePaginator(
            $builder->getResourceEntries(),
            $options->get('total_results', 0),
            $perPage,
            $page,
            compact('path')
        );

        $paginator->appends(app('request')->all());

        $pagination = $paginator->toArray();

        unset($pagination['data']);

        return $pagination;
    }
}
