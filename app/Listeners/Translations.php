<?php namespace App\Listeners;

use Anomaly\Streams\Platform\Event\Booted;
use App\Lang\Loader;
use Illuminate\Translation\Translator;

class Translations
{

    public function handle(Booted $event)
    {
        app()->singleton(
            'translation.loader',
            function ($application) {
                return new Loader($application['files'], $application['path.lang']);
            }
        );

        app()->singleton(
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

        if (defined('LOCALE')) {
            app()->setLocale(LOCALE);
            config()->set('app.locale', LOCALE);
        }
        // Set our locale namespace.
        app()->make('translator')->addNamespace('streams', realpath(__DIR__ . '/../../vendor/visiosoft/streams-platform/resources/lang'));

    }
}
