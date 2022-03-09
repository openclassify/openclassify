<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Application\Command\SetCoreConnection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ConfigureDatabase
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureDatabase
{

    use DispatchesJobs;

    /**
     * Handle the command.
     */
    public function handle()
    {
        config()->set('database', require base_path('config/database.php'));

        $this->dispatchNow(new SetCoreConnection());
    }
}
