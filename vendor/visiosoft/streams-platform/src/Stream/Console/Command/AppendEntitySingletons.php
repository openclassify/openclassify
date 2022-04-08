<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Writer;

/**
 * Class AppendEntitySingletons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntitySingletons
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
     * @param Writer $writer
     */
    public function handle(Writer $writer)
    {
        $suffix = studly_case($this->slug);

        $entity = str_singular($suffix);

        $addon  = $this->addon->getSlug();
        $slug   = studly_case($addon);
        $type   = studly_case($this->addon->getType());
        $vendor = studly_case($this->addon->getVendor());

        $prefix = "{$vendor}\\{$slug}{$type}";

        $path = $this->addon->getPath("src/{$slug}{$type}ServiceProvider.php");

        // Write uses
        $uses = "use {$prefix}\\{$entity}\\Contract\\{$entity}RepositoryInterface;\n";
        $uses .= "use {$prefix}\\{$entity}\\{$entity}Repository;\n";

        $writer->append($path, '/use.*;\n/i', $uses);

        // Write singletons.
        $writer->replace(
            $path,
            '/protected \$singletons = \[\]/i',
            "protected \$singletons = [\n    ]"
        );

        $writer->append(
            $path,
            '/protected \$singletons = \[\n/i',
            "        {$entity}RepositoryInterface::class => {$entity}Repository::class,\n"
        );
    }
}
