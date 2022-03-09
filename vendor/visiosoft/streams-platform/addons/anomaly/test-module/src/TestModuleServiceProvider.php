<?php namespace Anomaly\TestModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class TestModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
