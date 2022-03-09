<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Console\Command;

/**
 * Class SetAdminData
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetAdminData
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
     * Create a new SetAdminData instance.
     *
     * @param Collection $data
     * @param Command    $command
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
            'ADMIN_USERNAME',
            $this->command->ask(
                'Enter the desired username for the admin user',
                env('ADMIN_USERNAME', 'admin')
            )
        );

        $this->data->put(
            'ADMIN_EMAIL',
            $this->command->ask(
                'Enter the desired email for the admin user',
                env('ADMIN_EMAIL')
            )
        );

        // Validate email.
        if (!filter_var($this->data->get('ADMIN_EMAIL'), FILTER_VALIDATE_EMAIL)) {
            $this->command->error('You must provide a valid email for the admin.');

            exit;
        }

        $this->data->put(
            'ADMIN_PASSWORD',
            $this->command->ask(
                'Enter the desired password for the admin user',
                env('ADMIN_PASSWORD')
            )
        );
    }
}
