<?php namespace Anomaly\SettingsModule\Console;

use Anomaly\SettingsModule\Setting\Command\DumpSettings;
use Illuminate\Console\Command;

/**
 * Class Dump
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Dump extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'settings:dump';

    /**
     * Handle the command.
     */
    public function handle()
    {
        dispatch_now(new DumpSettings());

        $this->info('Wrote: ' . app_storage_path('settings/config.php'));
    }
}
