<?php namespace Anomaly\Streams\Platform\Ui\Tree;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Tree\Component\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Ui\Tree\Component\Item\ItemCollection;
use Anomaly\Streams\Platform\Ui\Tree\Contract\TreeRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class Tree
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Tree
{

    /**
     * The tree model.
     *
     * @var null|EloquentModel
     */
    protected $model = null;

    /**
     * The tree repository.
     *
     * @var TreeRepositoryInterface
     */
    protected $repository = null;

    /**
     * The tree stream.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The tree content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The tree response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * The tree data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The tree items.
     *
     * @var ItemCollection
     */
    protected $items;

    /**
     * The tree entries.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $entries;

    /**
     * The tree options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new Tree instance.
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
     * Set the tree response.
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
     * Get the tree response.
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
     * Get the tree repository.
     *
     * @return TreeRepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the tree repository.
     *
     * @param  TreeRepositoryInterface $repository
     * @return $this
     */
    public function setRepository(TreeRepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Set the tree stream.
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
     * Get the tree stream.
     *
     * @return null|StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the tree content.
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
     * Get the tree content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the tree options.
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
     * Get the tree options.
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
     * Set the tree entries.
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
     * Get the tree entries.
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
     * Set the tree data.
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
     * Get the tree data.
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
     * Set the tree items.
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
     * Get the tree items.
     *
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
