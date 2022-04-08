<?php namespace Anomaly\Streams\Platform\Ui\Grid;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item\ItemCollection;
use Anomaly\Streams\Platform\Ui\Grid\Contract\GridRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class Grid
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Grid
{

    /**
     * The grid model.
     *
     * @var null|EloquentModel
     */
    protected $model = null;

    /**
     * The grid repository.
     *
     * @var GridRepositoryInterface
     */
    protected $repository = null;

    /**
     * The grid stream.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The grid content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The grid response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * The grid data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The grid items.
     *
     * @var ItemCollection
     */
    protected $items;

    /**
     * The grid entries.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $entries;

    /**
     * The grid options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new Grid instance.
     *
     * @param Collection     $data
     * @param Collection     $options
     * @param Collection     $entries
     * @param Collection     $headers
     * @param ItemCollection $items
     */
    public function __construct(
        Collection $data,
        Collection $options,
        Collection $entries,
        Collection $headers,
        ItemCollection $items
    ) {
        $this->data    = $data;
        $this->items   = $items;
        $this->entries = $entries;
        $this->headers = $headers;
        $this->options = $options;
    }

    /**
     * Set the grid response.
     *
     * @param  null|Response $response
     * @return $this
     */
    public function setResponse(Response $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the grid response.
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
     * Get the grid repository.
     *
     * @return GridRepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the grid repository.
     *
     * @param  GridRepositoryInterface $repository
     * @return $this
     */
    public function setRepository(GridRepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Set the grid stream.
     *
     * @param  StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the grid stream.
     *
     * @return null|StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the grid content.
     *
     * @param  string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the grid content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the grid options.
     *
     * @param  Collection $options
     * @return $this
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the grid options.
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
     * @param        $key
     * @param  null  $default
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        return $this->options->get($key, $default);
    }

    /**
     * Set the grid entries.
     *
     * @param  Collection $entries
     * @return $this
     */
    public function setEntries(Collection $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * Get the grid entries.
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
     * Set the grid data.
     *
     * @param  Collection $data
     * @return $this
     */
    public function setData(Collection $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the grid data.
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Add a item to the item collection.
     *
     * @param  ItemInterface $item
     * @return $this
     */
    public function addItem(ItemInterface $item)
    {
        $this->items->push($item);

        return $this;
    }

    /**
     * Set the grid items.
     *
     * @param  ItemCollection $items
     * @return $this
     */
    public function setItems(ItemCollection $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get the grid items.
     *
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
