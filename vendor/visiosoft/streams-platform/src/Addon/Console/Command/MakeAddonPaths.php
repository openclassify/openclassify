<?php namespace Anomaly\Streams\Platform\Addon\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeAddonPaths
{

    /**
     * The addon slug.
     *
     * @var string
     */
    private $slug;

    /**
     * The addon type.
     *
     * @var string
     */
    private $type;

    /**
     * The vendor slug.
     *
     * @var string
     */
    private $vendor;

    /**
     * The command instance.
     *
     * @var Command
     */
    private $command;

    /**
     * Create a new MakeAddonPaths instance.
     *
     * @param         $vendor
     * @param         $type
     * @param         $slug
     * @param Command $command
     */
    public function __construct($vendor, $type, $slug, Command $command)
    {
        $this->slug    = $slug;
        $this->type    = $type;
        $this->vendor  = $vendor;
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param  Filesystem $filesystem
     * @param  Application $application
     * @return string
     */
    public function handle(Filesystem $filesystem, Application $application)
    {
        $shared = $this->command->option('shared') ? 'shared' : $application->getReference();

        $path = base_path("addons/{$shared}/{$this->vendor}/{$this->slug}-{$this->type}");

        $filesystem->makeDirectory($path, 0755, true, true);

        return $path;
    }
}
