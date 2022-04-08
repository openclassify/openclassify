<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * Class SetDatabasePrefix
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetDatabasePrefix
{

    use DispatchesJobs;

    /**
     * Handle the command.
     */
    public function handle()
    {
        /*
         * The INSTALLED variable in the .env file for the site module has been made dynamic.
         * Owner : Vedat Akdoğan
         */
        $app = (new ArgvInput())->getParameterOption('--app', env('APPLICATION_REFERENCE', 'default'));

        app('db')->getSchemaBuilder()->getConnection()->setTablePrefix($app . '_');
        app('db')->getSchemaBuilder()->getConnection()->getSchemaGrammar()->setTablePrefix(
            $app . '_'
        );
    }
}
