<?php namespace Anomaly\Streams\Platform\Asset\Console;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class Clear
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Clear extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'assets:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear compiled public assets.';

    /**
     * Execute the console command.
     *
     * @param Filesystem  $files
     * @param Application $application
     */
    public function handle(Filesystem $files, Application $application)
    {
        $directory = 'assets';

        if ($path = $this->argument('path')) {
            $directory .= DIRECTORY_SEPARATOR . str_replace('../', '', $path);
        }

        $files->deleteDirectory($directory = $application->getAssetsPath($directory), true);

        $this->info($directory . ' has been emptied!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['path', InputArgument::OPTIONAL, 'The asset path to delete.'],
        ];
    }
}
