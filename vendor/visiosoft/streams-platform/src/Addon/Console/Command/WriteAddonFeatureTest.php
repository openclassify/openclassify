<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteAddonFeatureTest
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteAddonFeatureTest
{

    /**
     * The addon path.
     *
     * @var string
     */
    private $path;

    /**
     * The addon type.
     *
     * @var string
     */
    private $type;

    /**
     * The addon slug.
     *
     * @var string
     */
    private $slug;

    /**
     * The vendor slug.
     *
     * @var string
     */
    private $vendor;

    /**
     * Create a new WriteAddonFeatureTest instance.
     *
     * @param $path
     * @param $type
     * @param $slug
     * @param $vendor
     */
    public function __construct($path, $type, $slug, $vendor)
    {
        $this->path   = $path;
        $this->slug   = $slug;
        $this->type   = $type;
        $this->vendor = $vendor;
    }

    /**
     * Handle the command.
     *
     * @param Parser     $parser
     * @param Filesystem $filesystem
     */
    public function handle(Parser $parser, Filesystem $filesystem)
    {
        $slug   = ucfirst(camel_case($this->slug));
        $type   = ucfirst(camel_case($this->type));
        $vendor = ucfirst(camel_case($this->vendor));

        $addon     = $slug . $type;
        $extends   = "{$addon}TestCase";
        $class     = $slug . $type . 'Test';
        $namespace = "{$vendor}\\{$addon}\\Test\\Feature";
        $use       = "{$vendor}\\{$addon}\\Test\\{$addon}TestCase";

        $path = "{$this->path}/tests/Feature/{$addon}Test.php";

        $template = $filesystem->get(
            base_path("vendor/visiosoft/streams-platform/resources/stubs/addons/tests/feature.stub")
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse($template, compact('namespace', 'class')));
    }
}
