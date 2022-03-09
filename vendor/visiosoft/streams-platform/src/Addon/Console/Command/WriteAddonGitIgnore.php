<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteAddonGitIgnore
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteAddonGitIgnore
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
     * Create a new WriteAddonGitIgnore instance.
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
        $path = "{$this->path}/.gitignore";

        $template = $filesystem->get(
            base_path('vendor/visiosoft/streams-platform/resources/stubs/addons/gitignore.stub')
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse($template));
    }
}
