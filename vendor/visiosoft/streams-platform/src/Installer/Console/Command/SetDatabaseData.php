<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Console\Command;

/**
 * Class SetDatabaseData
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetDatabaseData
{

    /**
     * The environment data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new SetDatabaseData instance.
     *
     * @param Collection $data
     * @param Command $command
     */
    public function __construct(Collection $data, Command $command)
    {
        $this->data    = $data;
        $this->command = $command;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->data->put(
            'DB_CONNECTION',
            $this->command->askWithCompletion(
                'What database driver would you like to use? [mysql, pgsql, sqlite, sqlsrv]',
                [
                    'mysql',
                    'pgsql',
                    'sqlite',
                    'sqlsrv',
                ],
                env('DB_CONNECTION', 'mysql')
            )
        );

        $this->data->put(
            'DB_HOST',
            $this->command->ask(
                'What is the hostname of your database?',
                env('DB_HOST', 'localhost')
            )
        );

        $this->data->put(
            'DB_DATABASE',
            $this->command->ask(
                'What is the name of your database?',
                env('DB_DATABASE')
            )
        );

        $this->data->put(
            'DB_USERNAME',
            $this->command->ask(
                'Enter the username for your database connection',
                env('DB_USERNAME', 'root')
            )
        );

        $this->data->put(
            'DB_PASSWORD',
            $this->command->ask(
                'Enter the password for your database connection',
                env('DB_PASSWORD')
            )
        );
    }
}
