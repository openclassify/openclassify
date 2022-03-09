<?php namespace Anomaly\Streams\Platform\Entry\Command;

use Composer\Autoload\ClassMapGenerator;
use Illuminate\Filesystem\Filesystem;

/**
 * Class GenerateEntryModelClassmap
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GenerateEntryModelClassmap
{

    /**
     * Handle the command.
     *
     * @param ClassMapGenerator $generator
     * @param Filesystem $files
     */
    public function handle(ClassMapGenerator $generator, Filesystem $files)
    {
        foreach ($files->directories(base_path('storage/streams')) as $directory) {
            if (is_dir($models = $directory . '/models')) {
                $generator->dump($files->directories($models), $models . '/classmap.php');
            }
        }
    }
}
