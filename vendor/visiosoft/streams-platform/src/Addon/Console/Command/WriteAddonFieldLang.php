<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class WriteAddonFieldLang
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WriteAddonFieldLang
{

    /**
     * The addon path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new WriteAddonFieldLang instance.
     *
     * @param $path
     * @param $type
     * @param $slug
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
        $path = "{$this->path}/resources/lang/en/field.php";

        $template = $filesystem->get(
            base_path('vendor/visiosoft/streams-platform/resources/stubs/addons/resources/lang/en/field.stub')
        );

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse($template));
    }
}
