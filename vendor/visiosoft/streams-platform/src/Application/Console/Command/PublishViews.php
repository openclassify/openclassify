<?php namespace Anomaly\Streams\Platform\Application\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishViews
{

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new PublishViews instance.
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
        $destination = $application->getResourcesPath('streams/views');

        if (is_dir($destination) && !$this->command->option('force')) {
            return $this->command->error("The $destination directory already exists.");
        }

        $filesystem->copyDirectory(__DIR__ . '/../../../../resources/views', $destination);

        $this->command->info("Published $destination");
    }
}
