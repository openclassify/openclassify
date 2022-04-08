<?php

namespace Anomaly\Streams\Platform\Application\Command;

use Dotenv\Dotenv;
use Illuminate\Support\Env;

/**
 * Class ReadEnvironmentFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ReloadEnvironmentFile
{

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!is_file($file = base_path('.env'))) {
            return;
        }

        foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {

            // Check for # comments.
            if (!starts_with($line, '#')) {
                putenv($line);
            }
        }

        /**
         * Force the internal management to reload
         * and overload from the changes that may
         * have taken place.
         */
        $dotenv = Dotenv::create(
            Env::getRepository(),
            app()->environmentPath(),
            app()->environmentFile()
        );

        $dotenv->load();
    }
}
