<?php

namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class GetStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetStream
{

    /**
     * The stream slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The stream namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Create a new GetStream instance.
     *
     * @param string $namespace
     * @param string|null $slug
     */
    public function __construct($namespace, $slug = null)
    {
        $this->slug      = $slug;
        $this->namespace = $namespace;
    }

    /**
     * Handle the command.
     *
     * @param  Container $container
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(Container $container)
    {

        /**
         * If the slug is not provided but
         * there is a dot in the namespace
         * then split the string into 
         * namespace and stream slug.
         */
        if (!$this->slug && strpos($this->namespace, '.')) {

            $parts = explode('.', $this->namespace);

            $this->slug      = $parts[1];
            $this->namespace = $parts[0];
        }

        /**
         * If the slug is not provided and
         * the namespace does NOT contain
         * a dot then the slug is assumed
         * to be the same as the namespace.
         */
        if (!$this->slug && strpos($this->namespace, '.') === false) {
            $this->slug = $this->namespace;
        }

        $this->slug      = studly_case($this->slug);
        $this->namespace = studly_case($this->namespace);

        /* @var EntryInterface $model */
        $model = $container->make(
            "Anomaly\\Streams\\Platform\\Model\\{$this->namespace}\\{$this->namespace}{$this->slug}EntryModel"
        );

        return $model->getStream();
    }
}
