<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Illuminate\Console\Command;

/**
 * Class ConfirmLicense
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfirmLicense
{

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new ConfirmLicense instance.
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
        $this->command->info(strip_tags((new \Parsedown())->parse(file_get_contents(base_path('LICENSE.md')))));

        if (!$this->command->confirm('Do you agree to the provided license and terms of service?')) {

            $this->command->error('You must agree to the license and terms of service before continuing.');

            exit;
        }
    }
}
