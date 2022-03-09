<?php namespace Visiosoft\StyleSelectorModule;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\View\ViewOverrides;
use Illuminate\Support\Facades\DB;

class StyleSelectorModuleServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'admin/style_selector' => 'Visiosoft\StyleSelectorModule\Http\Controller\Admin\StyleController@selector',
    ];

    protected $plugins = [
        StyleSelectorModulePlugin::class,
    ];

    protected $types = [
        'detail'
    ];

    public function register(ViewOverrides $overrides)
    {
        $provider_overrides = array();

        foreach ($this->types as $type) {
            $provider_overrides = array_merge($provider_overrides, $this->getOverridesByType($type));
        }

        foreach ($provider_overrides as $override_key => $override) {
            $overrides->put($override_key, $override);
        }
    }

    public function getOverridesByType($type)
    {
        $addonCollection = app(AddonCollection::class);
        $setting = DB::table('settings_settings')
            ->where('key', 'visiosoft.module.style_selector::' . $type)
            ->first();

        if ($setting) {
            $provider = $setting->value;

            $active_provider = $addonCollection->get($provider);

            if (isset($active_provider->overrides[$type])) {
                return $active_provider->overrides[$type];
            }
        }

        return [];
    }
}
