<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteEntityRoutes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteEntityRoutes
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
     * Create a new WriteEntityRoutes instance.
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
     * @param Parser     $parser
     * @param Filesystem $filesystem
     */
    public function handle(Parser $parser, Filesystem $filesystem)
    {
        $suffix = ucfirst(studly_case($this->slug));

        $first = count($filesystem->files($this->addon->getPath("migrations"))) == 1;

        $addon      = $this->addon->getSlug();
        $segment    = $first ? '' : '/' . $this->slug;
        $controller = $this->addon->getTransformedClass("Http\\Controller\\Admin\\{$suffix}Controller");

        $path = $this->addon->getPath("resources/routes/{$this->slug}.php");

        $template = $filesystem->get(
            base_path("vendor/visiosoft/streams-platform/resources/stubs/entity/http/routes.stub")
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse($template, compact('addon', 'segment', 'controller')));
    }
}
