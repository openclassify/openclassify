<?php namespace Visiosoft\ConnectModule\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class DeleteKeys
 *

 */
class DeleteKeys
{

    /**
     * Handle the command.
     *
     * @param Application $application
     * @param Filesystem $files
     */
    public function handle(Application $application, Filesystem $files)
    {
        if (!file_exists($application->getStoragePath('oauth-private.key'))) {
            return;
        }

        $files->delete($application->getStoragePath('oauth-private.key'));
        $files->delete($application->getStoragePath('oauth-public.key'));
    }
}
