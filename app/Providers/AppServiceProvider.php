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
		    if (auth()->check() and template()->get('cp')){
                if($variables = template()->get('cp')->getNavigation()->get('anomaly.module.variables')) {
                  $variables->setClass('hidden');
                }
                if($system = template()->get('cp')->getNavigation()->get('anomaly.module.system')) {
                  $system->setClass('hidden');
                }
                if($redirects = template()->get('cp')->getNavigation()->get('anomaly.module.redirects')) {
                  $redirects->setClass('hidden');
                }
                if($repeaters = template()->get('cp')->getNavigation()->get('anomaly.module.repeaters')) {
                  $repeaters->setClass('hidden');
                }
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

    }
}
