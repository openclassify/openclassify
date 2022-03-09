<?php namespace Visiosoft\BiolifeStyleProviderExtension;

use Visiosoft\StyleSelectorModule\Provider\ProviderExtension;

class BiolifeStyleProviderExtension extends ProviderExtension
{
    protected $provides = 'visiosoft.module.style_selector::provider.biolife';

    protected $thumbnail = 'visiosoft.extension.biolife_style_provider::images/detail_biolife.png';

    protected $overrides = [
        'detail' => [
            'visiosoft.module.carts::ad-detail/details'=> 'visiosoft.extension.biolife_style_provider::overrides/carts-module/ad-detail/details',
            'visiosoft.module.comments::ad-detail/content-tab'=> 'visiosoft.extension.biolife_style_provider::overrides/comments-module/ad-detail/content-tab',
            'visiosoft.module.comments::comments'=> 'visiosoft.extension.biolife_style_provider::overrides/comments-module/comments',
            'visiosoft.module.favs::ad-detail/title/action'=> 'visiosoft.extension.biolife_style_provider::overrides/favs-module/ad-detail/title/action',
            'visiosoft.module.qrcontact::ad-detail/content-tab'=> 'visiosoft.extension.biolife_style_provider::overrides/qrcontact-module/ad-detail/content-tab',
            'visiosoft.module.recommendedads::ad-detail/section'=> 'visiosoft.extension.biolife_style_provider::overrides/recommendedads-module/ad-detail/section',
            'visiosoft.module.store::ad-detail/owner'=> 'visiosoft.extension.biolife_style_provider::overrides/store-module/ad-detail/owner',
            'visiosoft.module.streetview::ad-detail/content-tab'=> 'visiosoft.extension.biolife_style_provider::overrides/streetview-module/ad-detail/content-tab',
        ]
    ];
}
