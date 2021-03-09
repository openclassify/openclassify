<?php

namespace App\Providers;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationFactory;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
	public function boot(ControlPanelBuilder $builder, NavigationFactory $factory)
    {
        view()->composer('*', function ($view) use ($builder, $factory) {

            if (auth()->check() and template()->get('cp')) {
	            //Hidden menu items in sidebar on dashboard
	            ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.variables')) ? $navigation->setClass('hidden') : false;
                ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.system')) ? $navigation->setClass('hidden') : false;
                ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.redirects')) ? $navigation->setClass('hidden') : false;
                ($navigation = template()->get('cp')->getNavigation()->get('anomaly.module.repeaters')) ? $navigation->setClass('hidden') : false;

                // Add new menu items in sidebar on dashboard
	            $newNavigations = [
		            [
			            'slug' => setting_value("streams::standard_theme"),
			            'icon' => 'fa fa-pencil-square-o',
			            'title' => 'visiosoft.theme.defaultadmin::section.theme_settings.name',
			            'attributes' => [
				            'href' => url("admin/settings/themes/" . setting_value("streams::standard_theme"))
			            ]
		            ]
	            ];
	            $cp = $builder->getControlPanel();
	            foreach ($newNavigations as $newNavigation) {
		            if (!template()->get('cp')->getNavigation()->get($newNavigation['slug'])){
			            $cp->addNavigationLink($factory->make($newNavigation));
		            }
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
        //
    }
}
