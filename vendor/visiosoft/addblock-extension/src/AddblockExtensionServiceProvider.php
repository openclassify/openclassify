<?php namespace Visiosoft\AddblockExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class AddblockExtensionServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        AddblockExtensionPlugin::class
    ];
}
