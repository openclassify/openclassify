<?php namespace Anomaly\Streams\Platform\Routing\Command;

use Anomaly\Streams\Platform\Application\Application;

class IncludeRoutes
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application)
    {
        if (file_exists($routes = base_path('resources/streams/routes.php'))) {
            include $routes;
        }

        if (file_exists($routes = $application->getResourcesPath('routes.php'))) {
            include $routes;
        }
    }
}
