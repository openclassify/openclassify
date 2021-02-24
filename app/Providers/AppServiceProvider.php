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
        view()->composer('*', function ($view) {
            //Hidden menu items in sidebar on dashboard
            if (auth()->check() and template()->get('cp')) {
                $is_hidden = ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.variables')) ? $navigation->setClass('hidden') : false;
                $is_hidden = ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.system')) ? $navigation->setClass('hidden') : false;
                $is_hidden = ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.redirects')) ? $navigation->setClass('hidden') : false;
                $is_hidden = ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.repeaters')) ? $navigation->setClass('hidden') : false;
            }
            //Auto Language Switcher
            if (config('advs.lang_switcher_for_browser') and is_null(Request()->session()->get('_locale')) and isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
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
