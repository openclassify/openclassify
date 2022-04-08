<?php namespace Anomaly\Streams\Platform\View\Twig\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class TwigClear
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TwigClear extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'twig:clear';

    /**
     * Handle the command.
     */
    public function handle(Filesystem $files)
    {
        if (!$files->isDirectory($directory = base_path('storage/framework/views/twig'))) {
            return;
        }

        $files->deleteDirectory($directory, true);
    }
}
