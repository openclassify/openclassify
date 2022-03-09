<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Application\Application;

/**
 * Class LoadEnvironmentOverrides
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadEnvironmentOverrides
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application)
    {
        if (!is_file($file = $application->getResourcesPath('.env'))) {
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
