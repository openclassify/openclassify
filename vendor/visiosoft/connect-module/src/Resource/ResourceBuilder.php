<?php namespace Visiosoft\ConnectModule\Resource;

use Visiosoft\ConnectModule\Resource\Command\BuildResource;
use Visiosoft\ConnectModule\Resource\Command\MakeResource;
use Visiosoft\ConnectModule\Resource\Command\SetResourceResponse;
use Visiosoft\ConnectModule\Resource\Component\Filter\Contract\FilterInterface;
use Visiosoft\ConnectModule\Resource\Component\Result\Contract\ResultInterface;
use Visiosoft\ConnectModule\Resource\Contract\ResourceRepositoryInterface;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResourceBuilder
 *

 * @package       Visiosoft\ConnectModule\Resource
 */
class ResourceBuilder
{

    use DispatchesJobs;
    use FiresCallbacks;

    /**
     * The resource stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * The resource stream slug.
     *
     * @var null|string
     */
    protected $stream = null;

    /**
     * The resource model.
     *
     * @var null|string
     */
    protected $model = null;

    /**
     * The ID to retrieve.
     *
     * @var null|int
     */
    protected $id = null;

    /**
     * The paginate to retrieve.
     *
     * @var true|boolean
     */
    protected $paginate = true;

    /**
     * The ID to retrieve.
     *
     * @var null|int
     */
    protected $function = null;

    /**
     * The entries handler.
     *
     * @var null|string
     */
    protected $entries = null;

    /**
     * The resource repository.
     *
     * @var null|ResourceRepositoryInterface
     */
    protected $repository = null;

    /**
     * The filters configuration.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The formatters configuration.
     *
     * @var array|string
     */
    protected $formatters = [];

    /**
     * The resource options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The resource object.
     *
     * @var Resource
     */
    protected $resource;

    /**
     * Create a new ResourceBuilder instance.
     *
     * @param Resource $resource
     */
    public function __construct(\Visiosoft\ConnectModule\Resource\Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Build the resource.
     *
     * @param null $namespace
     * @param null $stream
     */
    public function build($namespace = null, $stream = null)
    {
        $this->namespace = $namespace ?: $this->namespace;
        $this->stream    = $stream ?: $this->stream;

        $this->fire('ready', ['builder' => $this]);

        $this->dispatch(new BuildResource($this));
    }

    /**
     * Return the resource response.
     *
     * @param null $namespace
     * @param null $stream
     */
    public function make($namespace = null, $stream = null)
    {
        $this->build($namespace, $stream);

        $this->dispatch(new MakeResource($this));
    }

    /**
     * Return the resource response.
     *
     * @param null $namespace
     * @param null $stream
     * @return Response
     */
    public function response($namespace = null, $stream = null)
    {
        $this->make($namespace, $stream);

        $this->dispatch(new SetResourceResponse($this));

        return $this->resource->getResponse();
    }

    /**
     * Get the resource object.
     *
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the namespace.
     *
     * @param $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get the stream.
     *
     * @return null|string
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the stream.
     *
     * @param $stream
     * @return $this
     */
    public function setStream($stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID.
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the paginate.
     *
     * @return boolean|true
     */
    public function getPaginate()
    {
        return $this->paginate;
    }

    /**
     * @param $boolean
     * @return $this
     */
    public function setPaginate($boolean)
    {
        $this->paginate = $boolean;

        return $this;
    }


    /**
     * Get the Function.
     *
     * @return string|null
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set the Function.
     *
     * @param $function
     * @return $this
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Set the resource model.
     *
     * @param string $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the resource model.
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the entries.
     *
     * @return null|string
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set the entries.
     *
     * @param $entries
     * @return $this
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * Get the repository.
     *
     * @return ResourceRepositoryInterface|null
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the repository.
     *
     * @param ResourceRepositoryInterface $repository
     * @return $this
     */
    public function setRepository(ResourceRepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Set the filters configuration.
     *
     * @param $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Add a filter configuration.
     *
     * @param $filter
     * @return $this
     */
    public function addFilter($filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * Get the filters configuration.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set the formatters configuration.
     *
     * @param $formatters
     * @return $this
     */
    public function setFormatters($formatters)
    {
        $this->formatters = $formatters;

        return $this;
    }

    /**
     * Get the formatters configuration.
     *
     * @return array
     */
    public function getFormatters()
    {
        return $this->formatters;
    }

    /**
     * The the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get an option value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        return array_get($this->options, $key, $default);
    }

    /**
     * Set an option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        array_set($this->options, $key, $value);

        return $this;
    }

    /**
     * Get the resource's stream.
     *
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function getResourceStream()
    {
        return $this->resource->getStream();
    }

    /**
     * Get the resource model.
     *
     * @return \Anomaly\Streams\Platform\Model\EloquentModel|null
     */
    public function getResourceModel()
    {
        return $this->resource->getModel();
    }

    /**
     * Get a resource option value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getResourceOption($key, $default = null)
    {
        return $this->resource->getOption($key, $default);
    }

    /**
     * Set a resource option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setResourceOption($key, $value)
    {
        $this->resource->setOption($key, $value);

        return $this;
    }

    /**
     * Get the resource options.
     *
     * @return Collection
     */
    public function getResourceOptions()
    {
        return $this->resource->getOptions();
    }

    /**
     * Set the resource entries.
     *
     * @param Collection $entries
     * @return $this
     */
    public function setResourceEntries(Collection $entries)
    {
        $this->resource->setEntries($entries);

        return $this;
    }

    /**
     * Get the resource entries.
     *
     * @return Collection
     */
    public function getResourceEntries()
    {
        return $this->resource->getEntries();
    }

    /**
     * Add a result to the resource.
     *
     * @param ResultInterface $result
     * @return $this
     */
    public function addResourceResult(ResultInterface $result)
    {
        $this->resource->addResult($result);

        return $this;
    }

    /**
     * Add data to the resource.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addResourceData($key, $value)
    {
        $this->resource->addData($key, $value);

        return $this;
    }

    /**
     * Get an item from the resource's data.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getResourceDataItem($key, $default = null)
    {
        $data = $this->getResourceData();

        return $data->get($key, $default);
    }

    /**
     * Get the data collection.
     *
     * @return Collection
     */
    public function getResourceData()
    {
        return $this->resource->getData();
    }

    /**
     * Get the resource results.
     *
     * @return Component\Result\ResultCollection
     */
    public function getResourceResults()
    {
        return $this->resource->getResults();
    }

    /**
     * Set the resource response.
     *
     * @param Response $response
     */
    public function setResourceResponse(Response $response)
    {
        $this->resource->setResponse($response);
    }

    /**
     * Get the resource response.
     *
     * @return null|Response
     */
    public function getResourceResponse()
    {
        return $this->resource->getResponse();
    }

    /**
     * Get a request value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getRequestValue($key, $default = null)
    {
        return array_get($_REQUEST, $this->getOption('prefix') . $key, $default);
    }
}
