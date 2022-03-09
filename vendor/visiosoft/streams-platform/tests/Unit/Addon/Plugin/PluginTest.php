<?php

class PluginTest extends TestCase
{

    public function testCanGetName()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getName(), 'Anomaly\Streams\Platform\Addon\Plugin\Plugin');
    }

    public function testCanGetTokenParsers()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getTokenParsers(), []);
    }

    public function testCanGetNodeVisitors()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getNodeVisitors(), []);
    }

    public function testCanGetFilters()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getFilters(), []);
    }

    public function testCanGetTests()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getTests(), []);
    }

    public function testCanGetFunctions()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getFunctions(), []);
    }

    public function testCanGetOperators()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getOperators(), []);
    }

    public function testCanGetGlobals()
    {
        $plugin = $this->app->make(\Anomaly\Streams\Platform\Addon\Plugin\Plugin::class);

        $this->assertEquals($plugin->getGlobals(), []);
    }
}
