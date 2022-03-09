<?php namespace Anomaly\Streams\Platform\Application\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class PublishConfig
{
    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new PublishConfig instance.
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
        $destination = $application->getResourcesPath('streams/config');

        if (is_dir($destination) && !$this->command->option('force')) {
            return $this->command->error("The $destination directory already exists.");
        }

        $filesystem->copyDirectory(__DIR__ . '/../../../../resources/config', $destination);

        $this->command->info("Published $destination");
    }
}
