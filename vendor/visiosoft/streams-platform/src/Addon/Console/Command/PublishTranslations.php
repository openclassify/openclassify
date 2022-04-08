<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class PublishTranslations
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PublishTranslations
{

    /**
     * The addon instance.
     *
     * @var Addon
     */
    protected $addon;

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new PublishConfig instance.
     *
     * @param Addon   $addon
     * @param Command $command
     */
    public function __construct(Addon $addon, Command $command)
    {
        $this->addon   = $addon;
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
        $destination = $application->getResourcesPath(
            'addons/' .
            $this->addon->getVendor() . '/' .
            $this->addon->getSlug() . '-' .
            $this->addon->getType() . '/lang'
        );

        if (is_dir($destination) && !$this->command->option('force')) {

            $this->command->error("$destination already exists.");

            return;
        }

        $filesystem->copyDirectory($this->addon->getPath('resources/lang'), $destination);

        $this->command->info("Published $destination");
    }
}
