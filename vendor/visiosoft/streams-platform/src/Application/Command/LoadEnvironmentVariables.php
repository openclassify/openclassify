<?php namespace Anomaly\Streams\Platform\Application\Command;

/**
 * Class LoadEnvironmentVariables
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadEnvironmentVariables
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
    }
}
