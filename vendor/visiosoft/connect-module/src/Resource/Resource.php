<?php namespace Visiosoft\ConnectModule\Resource;

use Visiosoft\ConnectModule\Resource\Component\Result\Contract\ResultInterface;
use Visiosoft\ConnectModule\Resource\Component\Result\ResultCollection;
use Visiosoft\ConnectModule\Resource\Contract\ResourceRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Resource
 *

 * @package Visiosoft\ConnectModule\Resource
 */
class Resource
{

    /**
     * The resource model.
     *
     * @var null|EloquentModel
     */
    protected $model = null;

    /**
     * The resource repository.
     *
     * @var ResourceRepositoryInterface
     */
    protected $repository = null;

    /**
     * The resource stream.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The resource content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The resource response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * The resource data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The resource results.
     *
     * @var ResultCollection
     */
    protected $results;

    /**
     * The resource entries.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $entries;

    /**
     * The resource options.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $options;

    /**
     * Create a new Resource instance.
     *
     * @param Collection       $data
     * @param Collection       $options
     * @param Collection       $entries
     * @param ResultCollection $results
     */
    public function __construct(
        Collection $data,
        Collection $options,
        Collection $entries,
        ResultCollection $results
    ) {
        $this->data    = $data;
        $this->results = $results;
        $this->entries = $entries;
        $this->options = $options;
    }

    /**
     * Set the resource response.
     *
     * @param null|Response $response
     * @return $this
     */
    public function setResponse(Response $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the resource response.
     *
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the model object.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model object.
     *
     * @return null|EloquentModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the resource repository.
     *
     * @return ResourceRepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the resource repository.
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
     * Set the resource stream.
     *
     * @param StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the resource stream.
     *
     * @return null|StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the resource content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the resource content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the resource options.
     *
     * @param Collection $options
     * @return $this
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the resource options.
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set an option.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options->put($key, $value);

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
        return $this->options->get($key, $default);
    }

    /**
     * Set the resource entries.
     *
     * @param Collection $entries
     * @return $this
     */
    public function setEntries(Collection $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * Get the resource entries.
     *
     * @return Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Add data to the data collection.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value)
    {
        $this->data->put($key, $value);

        return $this;
    }

    /**
     * Set the resource data.
     *
     * @param Collection $data
     * @return $this
     */
    public function setData(Collection $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the resource data.
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Add a result to the result collection.
     *
     * @param ResultInterface $result
     * @return $this
     */
    public function addResult(ResultInterface $result)
    {
        $this->results->push($result);

        return $this;
    }

    /**
     * Set the resource results.
     *
     * @param ResultCollection $results
     * @return $this
     */
    public function setResults(ResultCollection $results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get the resource results.
     *
     * @return ResultCollection
     */
    public function getResults()
    {
        return $this->results;
    }
}
