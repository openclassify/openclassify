<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Writer;
use Illuminate\Filesystem\Filesystem;

/**
 * Class AppendEntityRoutes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntityRoutes
{

    /**
     * The entity slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The addon instance.
     *
     * @var Addon
     */
    protected $addon;

    /**
     * The entity stream namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Create a new WriteEntityModel instance.
     *
     * @param Addon $addon
     * @param       $slug
     * @param       $namespace
     */
    public function __construct(Addon $addon, $slug, $namespace)
    {
        $this->slug      = $slug;
        $this->addon     = $addon;
        $this->namespace = $namespace;
    }

    /**
     * Handle the command.
     *
     * @param Writer     $writer
     * @param Filesystem $files
     */
    public function handle(Writer $writer, Filesystem $files)
    {
        $suffix = studly_case($this->slug);

        $addon = $this->addon->getSlug();

        $slug   = studly_case($addon);
        $type   = studly_case($this->addon->getType());
        $vendor = studly_case($this->addon->getVendor());

        $streams = $files->glob($this->addon->getPath('migrations/*_stream.php'));

        $segment    = (count($streams) >= 1) ? "/{$this->slug}" : '';
        $prefix     = "{$vendor}\\{$slug}{$type}";
        $controller = "{$prefix}\\Http\\Controller\\Admin\\{$suffix}Controller";

        $path = $this->addon->getPath("src/{$slug}{$type}ServiceProvider.php");

        // Write routes
        $routes = "        'admin/{$addon}{$segment}'           => '{$controller}@index',\n";
        $routes .= "        'admin/{$addon}{$segment}/create'    => '{$controller}@create',\n";
        $routes .= "        'admin/{$addon}{$segment}/edit/{id}' => '{$controller}@edit',\n";

        $writer->replace(
            $path,
            '/protected \$routes = \[\]/i',
            "protected \$routes = [\n    ]"
        );

        $writer->append(
            $path,
            '/protected \$routes = \[\n/i',
            $routes
        );
    }
}
