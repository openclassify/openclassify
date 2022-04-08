<?php namespace Anomaly\Streams\Platform\View\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\View\Factory;

/**
 * Class AddViewNamespaces
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddViewNamespaces
{

    /**
     * Handle the command.
     *
     * @param Factory $views
     * @param Application $application
     */
    public function handle(Factory $views, Application $application)
    {

        /**
         * We still need the composer
         * for $view->make() overloading.
         */
        $views->composer('*', 'Anomaly\Streams\Platform\View\ViewComposer');

        $views->addNamespace(
            'streams',
            [
                $application->getResourcesPath(
                    "streams/views/"
                ),
                base_path('resources/streams/views'),
                __DIR__ . '/../../../resources/views',
            ]
        );

        $views->addNamespace('published', $application->getResourcesPath('addons'));
        $views->addNamespace('app', $application->getResourcesPath('views'));
        $views->addNamespace('storage', $application->getStoragePath());
        $views->addNamespace('shared', base_path('resources/views'));
        $views->addNamespace('root', base_path());
        $views->addExtension('html', 'php');
    }
}
