<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ScaffoldTheme
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ScaffoldTheme
{

    /**
     * Copy these theme folders.
     *
     * @var array
     */
    protected $copy = [
        'fonts',
        'js',
        'css',
        'scss',
        'views',
    ];

    /**
     * The addon path.
     *
     * @var string
     */
    private $path;

    /**
     * Create a new ScaffoldTheme instance.
     *
     * @param $path
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
    public function handle(Filesystem $filesystem)
    {
        foreach ($this->copy as $copy) {
            $filesystem->copyDirectory(
                base_path('vendor/visiosoft/streams-platform/resources/stubs/addons/resources/' . $copy),
                "{$this->path}/resources/" . $copy
            );
        }
    }
}
