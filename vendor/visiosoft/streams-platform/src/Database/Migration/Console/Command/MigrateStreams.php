<?php namespace Anomaly\Streams\Platform\Database\Migration\Console\Command;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MigrateStreams
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MigrateStreams
{

    use DispatchesJobs;

    /**
     * Streams migration paths.
     *
     * @var array
     */
    protected $paths = [
        'vendor/visiosoft/streams-platform/migrations/core',
        'vendor/visiosoft/streams-platform/migrations/application',
    ];

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new SetAddonPath instance.
     *
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        foreach ($this->paths as $path) {

            $options = [
                '--path' => $path,
            ];

            if ($this->command->option('force')) {
                $options['--force'] = true;
            }

            if ($this->command->option('pretend')) {
                $options['--pretend'] = true;
            }

            if ($this->command->option('seed')) {
                $options['--seed'] = true;
            }

            if ($database = $this->command->option('database')) {
                $options['--database'] = $database;
            }

            $this->command->call('migrate', $options);
        }

        return;
    }
}
