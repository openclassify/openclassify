<?php namespace Anomaly\Streams\Platform\Addon\Extension;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentObserver;

/**
 * Class ExtensionModel
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ExtensionModel extends EloquentModel implements ExtensionInterface
{

    /**
     * Define the table name.
     *
     * @var string
     */
    protected $table = 'addons_extensions';

    /**
     * Disable timestamps for extensions.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Find a extension by it's namespace or return a new
     * extension with the given namespace.
     *
     * @param  $namespace
     * @return ExtensionModel
     */
    public function findByNamespaceOrNew($namespace)
    {
        $extension = $this->findByNamespace($namespace);

        if ($extension instanceof ExtensionModel) {
            return $extension;
        }

        $extension = $this->newInstance();

        $extension->namespace = $namespace;

        $extension->save();

        return $extension;
    }

    /**
     * Find a extension by it's namespace.
     *
     * @param  $namespace
     * @return mixed
     */
    public function findByNamespace($namespace)
    {
        return $this->where('namespace', $namespace)->first();
    }

    /**
     * Get all enabled extension namespaces.
     *
     * @return EloquentCollection
     */
    public function getEnabledNamespaces()
    {
        return $this->where('enabled', true)->get()->pluck('namespace');
    }

    /**
     * Get all installed extension namespaces.
     *
     * @return EloquentCollection
     */
    public function getInstalledNamespaces()
    {
        return $this->where('installed', true)->get()->pluck('namespace');
    }

    /**
     * Return a new collection.
     *
     * @param  array $items
     * @return EloquentCollection
     */
    public function newCollection(array $items = [])
    {
        return new EloquentCollection($items);
    }
}
