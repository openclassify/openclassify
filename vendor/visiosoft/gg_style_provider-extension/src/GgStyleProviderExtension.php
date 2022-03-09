<?php namespace Visiosoft\GgStyleProviderExtension;

use Visiosoft\StyleSelectorModule\Provider\ProviderExtension;

class GgStyleProviderExtension extends ProviderExtension
{
    protected $provides = 'visiosoft.module.style_selector::provider.gg';

    protected $thumbnail = 'visiosoft.extension.gg_style_provider::images/detail_gg.png';

    protected $overrides = [
        'detail' => [
            'visiosoft.module.favs::ad-detail/title/action'=> 'visiosoft.extension.gg_style_provider::overrides/favs-module/ad-detail/title/action',
        ]
    ];
}
