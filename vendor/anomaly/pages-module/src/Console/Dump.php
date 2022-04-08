<?php namespace Anomaly\PagesModule\Console;

use Anomaly\PagesModule\Page\Command\DumpPages;
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
    protected $name = 'pages:dump';

    /**
     * Handle the command.
     */
    public function handle()
    {
        dispatch_now(new DumpPages());

        $this->info('Wrote: ' . app_storage_path('pages/routes.php'));
    }
}
