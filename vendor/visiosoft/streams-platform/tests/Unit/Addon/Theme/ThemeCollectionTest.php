<?php

class ThemeCollectionTest extends TestCase
{

    public function testCanReturnActiveAdminTheme()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Theme\ThemeCollection::class);

        $this->assertInstanceOf(Anomaly\Streams\Platform\Addon\Theme\Theme::class, $collection->active('admin'));
        $this->assertTrue($collection->active('admin')->isAdmin());
    }

    public function testCanReturnActiveStandardTheme()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Theme\ThemeCollection::class);

        $this->assertInstanceOf(Anomaly\Streams\Platform\Addon\Theme\Theme::class, $collection->active('standard'));
        $this->assertFalse($collection->active('standard')->isAdmin());
    }

    public function testReturnsActiveCurrentByDefault()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Theme\ThemeCollection::class);

        $this->assertInstanceOf(Anomaly\Streams\Platform\Addon\Theme\Theme::class, $collection->active());
        $this->assertFalse($collection->active()->isAdmin());
    }

    public function testCanReturnAdminThemes()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Theme\ThemeCollection::class);

        $this->assertNotNull($collection->admin()->get('anomaly.theme.test_admin'));
    }

    public function testCanReturnStandardThemes()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Theme\ThemeCollection::class);

        $this->assertNotNull($collection->standard()->get('anomaly.theme.test_standard'));
    }
}
