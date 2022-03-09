<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Lang\Loader;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Translation\Translator;

/**
 * Class ConfigureTranslator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureTranslator
{

    /**
     * Handle the command.
     *
     * @param Repository $config
     * @param Application $application
     */
    public function handle(Repository $config, Application $application)
    {
        // First trigger to resolve.
        $application->make('translator');

        /*
         * Change the lang loader so we can
         * add a few more necessary override
         * paths to the API.
         */
        $application->singleton(
            'translation.loader',
            function ($application) {
                return new Loader($application['files'], $application['path.lang']);
            }
        );

        /*
         * Re-bind the translator so we can use
         * the new loader defined above.
         */
        $application->singleton(
            'translator',
            function ($application) {
                $loader = $application->make('translation.loader');

                // When registering the translator component, we'll need to set the default
                // locale as well as the fallback locale. So, we'll grab the application
                // configuration so we can easily get both of these values from there.
                $locale = $application['config']['app.locale'];

                $trans = new Translator($loader, $locale);

                $trans->setFallback($application['config']['app.fallback_locale']);

                return $trans;
            }
        );

        /*
         * Set the locale if LOCALE is defined.
         *
         * LOCALE is defined first thing in our
         * HTTP Kernel. Respect it!
         */
        if (defined('LOCALE')) {
            $application->setLocale(LOCALE);
            $config->set('app.locale', LOCALE);
        }

        // Set our locale namespace.
        $application->make('translator')->addNamespace('streams', realpath(__DIR__ . '/../../../resources/lang'));

        // Polyfill ->trans()
        $application->make('translator')->macro('trans', function($key, array $replace = [], $locale = null, $fallback = true) {
            return app('translator')->get($key, $replace, $locale, $fallback);
        });
    }
}
