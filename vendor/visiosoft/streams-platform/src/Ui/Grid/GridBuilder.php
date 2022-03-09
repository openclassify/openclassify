<?php namespace Anomaly\Streams\Platform\Ui\Grid;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\Grid\Command\AddAssets;
use Anomaly\Streams\Platform\Ui\Grid\Command\BuildGrid;
use Anomaly\Streams\Platform\Ui\Grid\Command\LoadGrid;
use Anomaly\Streams\Platform\Ui\Grid\Command\MakeGrid;
use Anomaly\Streams\Platform\Ui\Grid\Command\PostGrid;
use Anomaly\Streams\Platform\Ui\Grid\Command\SetGridResponse;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Ui\Grid\Contract\GridRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class GridBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GridBuilder
{
    use FiresCallbacks;
    use DispatchesJobs;

    /**
     * The grid model.
     *
     * @var null|string
     */
    protected $model = null;

    /**
     * The buttons configuration.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The grid options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The grid assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * The grid instance.
     *
     * @var Grid
     */
    protected $grid;

    /**
     * Create a new GridBuilder instance.
     *
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Build the grid.
     */
    public function build()
    {
        $this->fire('ready', ['builder' => $this]);

        $this->dispatchNow(new BuildGrid($this));

        if (app('request')->isMethod('post')) {
            $this->dispatchNow(new PostGrid($this));
        }
    }

    /**
     * Make the grid response.
     */
    public function make()
    {
        $this->build();

        if (!app('request')->isMethod('post')) {
            $this->dispatchNow(new LoadGrid($this));
            $this->dispatchNow(new AddAssets($this));
            $this->dispatchNow(new MakeGrid($this));
        }
    }

    /**
     * Render the grid.
     *
     * @return Response
     */
    public function render()
    {
        $this->make();

        $this->dispatchNow(new SetGridResponse($this));

        return $this->grid->getResponse();
    }

    /**
     * Get the grid.
     *
     * @return Grid
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Set the grid model.
     *
     * @param  string $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the grid model.
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the buttons configuration.
     *
     * @param $buttons
     * @return $this
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get the buttons configuration.
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
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
     * @param  array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

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
     * Get the assets.
     *
     * @return array
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Set the assets.
     *
     * @param $assets
     * @return $this
     */
    public function setAssets($assets)
    {
        $this->assets = $assets;

        return $this;
    }

    /**
     * Add an asset.
     *
     * @param $collection
     * @param $asset
     * @return $this
     */
    public function addAsset($collection, $asset)
    {
        if (!isset($this->assets[$collection])) {
            $this->assets[$collection] = [];
        }

        $this->assets[$collection][] = $asset;

        return $this;
    }

    /**
     * Get the grid's stream.
     *
     * @return StreamInterface|null
     */
    public function getGridStream()
    {
        return $this->grid->getStream();
    }

    /**
     * Get the grid model.
     *
     * @return EloquentModel|null
     */
    public function getGridModel()
    {
        return $this->grid->getModel();
    }

    /**
     * Get a grid option value.
     *
     * @param        $key
     * @param  null  $default
     * @return mixed
     */
    public function getGridOption($key, $default = null)
    {
        return $this->grid->getOption($key, $default);
    }

    /**
     * Set a grid option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setGridOption($key, $value)
    {
        $this->grid->setOption($key, $value);

        return $this;
    }

    /**
     * Get the grid options.
     *
     * @return Collection
     */
    public function getGridOptions()
    {
        return $this->grid->getOptions();
    }

    /**
     * Set the grid entries.
     *
     * @param  Collection $entries
     * @return $this
     */
    public function setGridEntries(Collection $entries)
    {
        $this->grid->setEntries($entries);

        return $this;
    }

    /**
     * Get the grid entries.
     *
     * @return Collection
     */
    public function getGridEntries()
    {
        return $this->grid->getEntries();
    }

    /**
     * Add a grid item to the collection.
     *
     * @param  ItemInterface $item
     * @return $this
     */
    public function addGridItem(ItemInterface $item)
    {
        $this->grid->addItem($item);

        return $this;
    }

    /**
     * Set the grid response.
     *
     * @param Response $response
     */
    public function setGridResponse(Response $response)
    {
        $this->grid->setResponse($response);
    }

    /**
     * Get the grid response.
     *
     * @return null|Response
     */
    public function getGridResponse()
    {
        return $this->grid->getResponse();
    }

    /**
     * Get the grid repository.
     *
     * @return GridRepositoryInterface
     */
    public function getGridRepository()
    {
        return $this->grid->getRepository();
    }

    /**
     * Get a request value.
     *
     * @param        $key
     * @param  null  $default
     * @return mixed
     */
    public function getRequestValue($key, $default = null)
    {
        return array_get($_REQUEST, $this->getOption('prefix') . $key, $default);
    }
}
