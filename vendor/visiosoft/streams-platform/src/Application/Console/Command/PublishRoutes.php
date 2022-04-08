<?php namespace Anomaly\Streams\Platform\Application\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class PublishRoutes
{
    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new PublishRoutes instance.
     *
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param  Filesystem  $filesystem
     * @param  Application $application
     * @return string
     */
    public function handle(Filesystem $filesystem, Application $application)
    {
        $destination = $application->getResourcesPath('routes.php');

        if (!is_dir(dirname($destination))) {
            $filesystem->makeDirectory(dirname($destination), 0777, true, true);
        }

        if (is_file($destination) && !$this->command->option('force')) {
            return $this->command->error("$destination already exists.");
        }

        $content = "<?php

// Route::get('/', function () {
//     return view('welcome');
// });
";

        $filesystem->put($destination, $content);

        $this->command->info("Published $destination");
    }
}
