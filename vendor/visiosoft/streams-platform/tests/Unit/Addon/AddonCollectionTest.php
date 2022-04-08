<?php

class AddonCollectionTest extends TestCase
{

    public function testKeysByNamespace()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Module\ModuleCollection::class);

        $collection = new \Anomaly\Streams\Platform\Addon\Module\ModuleCollection($collection->all());

        $this->assertNotNull($collection->all()['anomaly.module.test']);
    }

    public function testCanGetBySlug()
    {
        $collection = $this->app->make(\Anomaly\Streams\Platform\Addon\Module\ModuleCollection::class);

        $this->assertNotNull($collection->get('test'));
    }
}
