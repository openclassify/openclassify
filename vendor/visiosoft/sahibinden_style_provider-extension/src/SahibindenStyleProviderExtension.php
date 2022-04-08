<?php namespace Visiosoft\SahibindenStyleProviderExtension;

use Visiosoft\StyleSelectorModule\Provider\ProviderExtension;

class SahibindenStyleProviderExtension extends ProviderExtension
{
    protected $provides = 'visiosoft.module.style_selector::provider.sahibinden';

    protected $thumbnail = 'visiosoft.extension.sahibinden_style_provider::images/detail_sahibinden.png';

    protected $overrides = [
        'detail' => [
            'visiosoft.module.comments::ad-detail/content'=> 'visiosoft.extension.sahibinden_style_provider::overrides/comments-module/ad-detail/content',
            'visiosoft.module.comments::ad-detail/content-tab'=> 'visiosoft.extension.sahibinden_style_provider::overrides/comments-module/ad-detail/content-tab',
            'visiosoft.module.complaints::ad-detail/title/button'=> 'visiosoft.extension.sahibinden_style_provider::overrides/complaints-module/ad-detail/title/button',
            'visiosoft.module.customfields::ad-detail/checkboxes'=> 'visiosoft.extension.sahibinden_style_provider::overrides/customfields-module/ad-detail/checkboxes',
            'visiosoft.module.customfields::ad-detail/content'=> 'visiosoft.extension.sahibinden_style_provider::overrides/customfields-module/ad-detail/content',
            'visiosoft.module.customfields::ad-detail/content-tab'=> 'visiosoft.extension.sahibinden_style_provider::overrides/customfields-module/ad-detail/content-tab',
            'visiosoft.module.pricehistory::ad-detail/content'=> 'visiosoft.extension.sahibinden_style_provider::overrides/pricehistory-module/ad-detail/content',
            'visiosoft.module.pricehistory::ad-detail/content-tab'=> 'visiosoft.extension.sahibinden_style_provider::overrides/pricehistory-module/ad-detail/content-tab',
            'visiosoft.module.qrcontact::ad-detail/content'=> 'visiosoft.extension.sahibinden_style_provider::overrides/qrcontact-module/ad-detail/content',
            'visiosoft.module.recommendedads::ad-detail/section'=> 'visiosoft.extension.sahibinden_style_provider::overrides/recommendedads-module/ad-detail/section',
            'visiosoft.module.recommendedads::recommended-horizonal'=> 'visiosoft.extension.sahibinden_style_provider::overrides/recommendedads-module/recommended-horizonal',
            'visiosoft.module.recommendedads::recommended-vertical'=> 'visiosoft.extension.sahibinden_style_provider::overrides/recommendedads-module/recommended-vertical',
            'visiosoft.module.streetview::ad-detail/content'=> 'visiosoft.extension.sahibinden_style_provider::overrides/streetview-module/ad-detail/content',
            'visiosoft.module.streetview::ad-detail/content-tab'=> 'visiosoft.extension.sahibinden_style_provider::overrides/streetview-module/ad-detail/content-tab',
        ]
    ];
}
