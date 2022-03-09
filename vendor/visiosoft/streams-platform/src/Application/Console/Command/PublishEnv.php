<?php namespace Anomaly\Streams\Platform\Application\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class PublishEnv
{
    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new PublishEnv instance.
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
        $destination = $application->getResourcesPath('.env');

        if (!is_dir(dirname($destination))) {
            $filesystem->makeDirectory(dirname($destination), 0777, true, true);
        }

        if (is_file($destination) && !$this->command->option('force')) {
            return $this->command->error("$destination already exists.");
        }

        $filesystem->put($destination, '#EXAMPLE=foo');

        $this->command->info("Published $destination");
    }
}
