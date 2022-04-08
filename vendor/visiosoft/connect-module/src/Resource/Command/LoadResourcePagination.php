<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\Resource;
use Visiosoft\ConnectModule\Resource\ResourcePagination;


/**
 * Class LoadResourcePagination
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class LoadResourcePagination
{

    /**
     * The resource object.
     *
     * @var Resource
     */
    protected $resource;

    /**
     * Create a new LoadResourcePagination instance.
     *
     * @param Resource $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Handle the command.
     *
     * @param ResourcePagination $pagination
     */
    public function handle(ResourcePagination $pagination)
    {
        $data = $this->resource->getData();

        if ($this->resource->getOption('paginate') === false) {
            return;
        }

        $pagination = $pagination->make($this->resource);

        $data->put('pagination', $pagination);
    }
}
