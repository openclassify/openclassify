<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteThemePackage
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteThemePackage
{

    /**
     * The addon path.
     *
     * @var string
     */
    private $path;

    /**
     * Create a new WriteThemePackage instance.
     *
     * @param $path
     * @param $type
     * @param $slug
     * @param $vendor
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Handle the command.
     *
     * @param Parser $parser
     * @param Filesystem $filesystem
     */
    public function handle(Parser $parser, Filesystem $filesystem)
    {
        $path = "{$this->path}/package.json";

        $template = $filesystem->get(
            base_path('vendor/visiosoft/streams-platform/resources/stubs/addons/package.theme.stub')
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse($template));
    }
}
