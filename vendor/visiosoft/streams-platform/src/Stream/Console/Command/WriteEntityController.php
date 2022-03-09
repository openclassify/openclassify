<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteEntityController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteEntityController
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
     * Determines if tree builder use
     *
     * @var boolean
     */
    protected $nested;

    /**
     * Create a new WriteEntityController instance.
     *
     * @param Addon $addon
     * @param       $slug
     * @param       $namespace
     */
    public function __construct(Addon $addon, $slug, $namespace, $nested = false)
    {
        $this->slug      = $slug;
        $this->addon     = $addon;
        $this->nested    = $nested;
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
        $suffix = ucfirst(camel_case($this->slug));
        $entity = str_singular($suffix);

        $class       = "{$suffix}Controller";
        $form        = "{$entity}FormBuilder";
        $namespace   = $this->addon->getTransformedClass('Http\\Controller\\Admin');
        $formBuilder = $this->addon->getTransformedClass("{$entity}\\Form\\{$entity}FormBuilder");

        $view = $this->nested
            ? 'tree'
            : 'table';

        $table = $this->nested
            ? "{$entity}TreeBuilder"
            : "{$entity}TableBuilder";

        $tableBuilder = $this->nested
            ? $this->addon->getTransformedClass("{$entity}\\Tree\\{$entity}TreeBuilder")
            : $this->addon->getTransformedClass("{$entity}\\Table\\{$entity}TableBuilder");

        $path = $this->addon->getPath("src/Http/Controller/Admin/{$suffix}Controller.php");

        $template = $filesystem->get(
            base_path('vendor/visiosoft/streams-platform/resources/stubs/entity/http/controller/admin.stub')
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put(
            $path,
            $parser->parse(
                $template,
                compact('class', 'namespace', 'formBuilder', 'tableBuilder', 'form', 'table', 'view')
            )
        );
    }
}
