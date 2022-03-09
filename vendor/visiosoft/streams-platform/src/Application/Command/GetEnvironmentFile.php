<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Application\Application;

/**
 * Class GetEnvironmentFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetEnvironmentFile
{

    /**
     * Handle the command.
     *
     * @param Application $application
     * @return string
     */
    public function handle(Application $application)
    {
        $file = $application->getResourcesPath('.env');

        if (!file_exists($file)) {
            return base_path('.env');
        }

        return $file;
    }
}
