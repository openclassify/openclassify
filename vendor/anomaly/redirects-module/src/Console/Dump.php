<?php namespace Anomaly\RedirectsModule\Console;

use Anomaly\RedirectsModule\Domain\Command\DumpDomains;
use Anomaly\RedirectsModule\Redirect\Command\DumpRedirects;
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
    protected $name = 'redirects:dump';

    /**
     * Handle the command.
     */
    public function handle()
    {
        dispatch_now(new DumpDomains());
        $this->info('Wrote: ' . app_storage_path('redirects/domains.php'));

        dispatch_now(new DumpRedirects());
        $this->info('Wrote: ' . app_storage_path('redirects/routes.php'));
    }
}
