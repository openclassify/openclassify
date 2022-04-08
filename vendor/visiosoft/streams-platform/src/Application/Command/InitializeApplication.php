<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Foundation\Application as Laravel;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * Class InitializeApplication
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InitializeApplication
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application, Laravel $laravel)
    {
        $app = env('APPLICATION_REFERENCE', 'default');

        if (PHP_SAPI == 'cli') {

            if (!defined('IS_ADMIN')) {
                define('IS_ADMIN', false);
            }

            $app = (new ArgvInput())->getParameterOption('--app', $app);

            $laravel->bind(
                'path.public',
                function () use ($laravel) {
                    if ($path = env('PUBLIC_PATH')) {
                        return base_path($path);
                    }

                    // Check default path.
                    if (file_exists($path = base_path('public/index.php'))) {
                        return dirname($path);
                    }

                    // Check common alternative.
                    if (file_exists($path = base_path('public_html/index.php'))) {
                        return dirname($path);
                    }

                    return base_path('public');
                }
            );
        }

        /*
         * Set the reference to our default first.
         * When in a dev environment and working
         * with Artisan this the same as locating.
         */
        $application->setReference($app);

        /*
         * If the application is installed
         * then locate the application and
         * initialize.
         */
        if (env('DB_CONNECTION', env('DB_DRIVER'))) {

            try {

                $application->setup();
                
                if ($application->isInstalled()) {
                    if (PHP_SAPI != 'cli') {
                        $application->locate();
                    }

                    if (!$application->isEnabled()) {
                        abort(503);
                    }
                }
            } catch (\Exception $e) {
                // Do nothing.
            }
        }
    }
}
