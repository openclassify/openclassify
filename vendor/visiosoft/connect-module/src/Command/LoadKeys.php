<?php namespace Visiosoft\ConnectModule\Command;

use Anomaly\Streams\Platform\Application\Application;
use Laravel\Passport\Passport;

/**
 * Class LoadKeys
 *

 */
class LoadKeys
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application)
    {
        Passport::loadKeysFrom($application->getStoragePath());
    }
}
