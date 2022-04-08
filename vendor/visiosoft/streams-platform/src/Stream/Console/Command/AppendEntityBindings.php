<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Writer;

/**
 * Class AppendEntityBindings
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntityBindings
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

        $addon = $this->addon->getSlug();

        $slug   = studly_case($addon);
        $type   = studly_case($this->addon->getType());
        $vendor = studly_case($this->addon->getVendor());

        $prefix = "{$vendor}\\{$slug}{$type}";

        $path = $this->addon->getPath("src/{$slug}{$type}ServiceProvider.php");

        // Write use statements.
        $uses = "use Anomaly\\Streams\\Platform\\Model\\{$slug}\\{$slug}{$suffix}EntryModel;\n";
        $uses .= "use {$prefix}\\{$entity}\\{$entity}Model;\n";

        $writer->append($path, '/use.*;\n/i', $uses);

        // Write bindings.
        $writer->replace(
            $path,
            '/protected \$bindings = \[\]/i',
            "protected \$bindings = [\n    ]"
        );

        $writer->append(
            $path,
            '/protected \$bindings = \[\n/i',
            "        {$slug}{$suffix}EntryModel::class => {$entity}Model::class,\n"
        );
    }
}
