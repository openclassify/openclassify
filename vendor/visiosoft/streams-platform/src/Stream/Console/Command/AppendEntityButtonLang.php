<?php namespace Anomaly\Streams\Platform\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Console\Command\WriteAddonButtonLang;
use Anomaly\Streams\Platform\Support\Writer;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AppendEntityButtonLang
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AppendEntityButtonLang
{

    use DispatchesJobs;

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
     * Create a new WriteEntityModel instance.
     *
     * @param Addon $addon
     * @param       $slug
     */
    public function __construct(Addon $addon, $slug)
    {
        $this->slug  = $slug;
        $this->addon = $addon;
    }

    /**
     * Handle the command.
     *
     * @param Writer $writer
     * @param Filesystem $files
     */
    public function handle(Writer $writer, Filesystem $files)
    {

        if (!$files->exists($path = $this->addon->getPath("resources/lang/en/button.php"))) {
            $this->dispatchNow(new WriteAddonButtonLang($this->addon->getPath()));
        }

        $singular = str_singular($this->slug);

        $name = ucfirst(humanize($singular));

        $button = "    'new_{$singular}' => 'New {$name}',\n";

        $writer->replace(
            $path,
            '/return \[\];/i',
            "return [\n];"
        );

        $writer->prepend(
            $path,
            '/];/i',
            $button
        );
    }
}
