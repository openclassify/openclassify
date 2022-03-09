<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

/**
 * Class TableCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TableCriteria
{

    use FiresCallbacks;

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The cache repository.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The parameters.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Create a new TableCriteria instance.
     *
     * @param UrlGenerator $url
     * @param Repository $cache
     * @param Request $request
     * @param Hydrator $hydrator
     * @param Container $container
     * @param TableBuilder $builder
     * @param array $parameters
     */
    public function __construct(
        UrlGenerator $url,
        Repository $cache,
        Request $request,
        Hydrator $hydrator,
        Container $container,
        TableBuilder $builder,
        array $parameters = []
    ) {
        $this->url        = $url;
        $this->cache      = $cache;
        $this->builder    = $builder;
        $this->request    = $request;
        $this->hydrator   = $hydrator;
        $this->container  = $container;
        $this->parameters = $parameters;

        $this->setBuilder($builder);

        $this->fire('initialized', ['criteria' => $this]);
    }

    /**
     * Get the table.
     *
     * @return TablePresenter
     */
    public function get()
    {
        $this->build();

        return (new Decorator())->decorate($this->builder->make()->getTable());
    }

    /**
     * Build the builder.
     *
     * @return TableBuilder
     */
    public function build()
    {

        /*
         * Hide breadcrumbs by default.
         */
        array_set(
            $this->parameters,
            'options.breadcrumb',
            array_get(
                $this->parameters,
                'options.breadcrumb',
                false
            )
        );

        /*
         * Cache and hash!
         */
        array_set($this->parameters, 'key', md5(json_encode($this->parameters)));

        /*
         * Set the tables URL after obtaining
         * our parameter hash for the table.
         */
        array_set(
            $this->parameters,
            'options.url',
            array_get(
                $this->parameters,
                'options.url',
                $this->url->to($this->builder->getOption('url', 'table/handle/' . array_get($this->parameters, 'key')))
            )
        );

        $this->cache->remember(
            'table::' . array_get($this->parameters, 'key'),
            1440,
            function () {
                return $this->parameters;
            }
        );

        if (is_array(array_get($this->parameters, 'options'))) {
            foreach (array_pull($this->parameters, 'options') as $key => $value) {
                $this->builder->setOption($key, $value);
            }
        }

        return $this->hydrator->hydrate($this->builder, $this->parameters);
    }

    /**
     * Set a parameter.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * Get the builder.
     *
     * @return TableBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Set the table builder.
     *
     * @param  TableBuilder $builder
     * @return $this
     */
    public function setBuilder($builder)
    {
        if (!is_object($builder)) {
            $builder = app($builder);
        }

        $this->builder = $builder;

        if (!isset($this->parameters['builder'])) {
            array_set($this->parameters, 'builder', get_class($this->builder));
        }

        return $this;
    }

    /**
     * Route through __get
     *
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        return $this->__call($name, []);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $method = camel_case('set_' . $name))) {

            call_user_func([$this, $method], (new Decorator())->undecorate(array_shift($arguments)));

            return $this;
        }

        if (method_exists($this, $method = camel_case('add_' . $name))) {

            call_user_func([$this, $method], (new Decorator())->undecorate(array_shift($arguments)));

            return $this;
        }

        if (method_exists($this->builder, camel_case('set_' . $name))) {

            array_set($this->parameters, $name, (new Decorator())->undecorate(array_shift($arguments)));

            return $this;
        }

        if (method_exists($this->builder, camel_case('add_' . $name))) {

            array_set($this->parameters, $name, (new Decorator())->undecorate(array_shift($arguments)));

            return $this;
        }

        if (!method_exists($this->builder, camel_case($name)) && count($arguments) === 1) {

            $key = snake_case($name);

            array_set($this->parameters, "options.{$key}", (new Decorator())->undecorate(array_shift($arguments)));

            return $this;
        }

        if (!method_exists($this->builder, camel_case($name)) && count($arguments) === 0) {

            $key = snake_case($name);

            // Helpful for table.disableLabels().disableFoo() ...
            array_set($this->parameters, "options.{$key}", true);

            return $this;
        }

        return $this;
    }

    /**
     * Return the table.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->get()->__toString();
    }
}
