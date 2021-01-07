<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Auto Language Switcher
        view()->composer('*', function ($view) {
            if (config('advs.lang_switcher_for_browser') and is_null(Request()->session()->get('_locale'))) {
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);//Get Browser Language
                $acceptLang = config('streams::locales.enabled'); //Supported Language
                $lang = in_array($lang, $acceptLang) ? $lang : config('streams::locales.default', 'en');
                App()->setLocale($lang);
                Request()->session()->put('_locale', $lang);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
