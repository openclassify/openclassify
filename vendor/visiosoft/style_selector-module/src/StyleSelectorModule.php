<?php namespace Visiosoft\StyleSelectorModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class StyleSelectorModule extends Module
{
    protected $navigation = true;

    protected $icon = 'fa fa-gg';

    public function getSections()
    {
        return [
            'style_selector' => [
                'buttons' => [
                    'detail_settings' => [
                        'href' => '/admin/settings/extensions/'.setting_value('visiosoft.module.style_selector::detail'),
                        'type' => 'success',
                        'icon' => 'fa fa-cog'
                    ],
                ],
            ],
        ];
    }
}
