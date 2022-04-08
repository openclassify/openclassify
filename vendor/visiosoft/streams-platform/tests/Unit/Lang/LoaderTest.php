<?php

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Filesystem\Filesystem;

/**
 * Class LoaderTest
 */
class LoaderTest extends TestCase
{

    public function testCanLoadAddonsWithOverrides()
    {

        /** @var Filesystem $files */
        $files = $this->app->make(Filesystem::class);
        $this->app->setLocale('en');

        /** @var Module $testModule */
        $testModule = $this->app->make(AddonCollection::class)->get('anomaly.module.test');

        $overrideArray = $files->getRequire(
            $testModule->getPath("resources/addons/anomaly/test_standard-theme/lang/en/addon.php")
        );

        $this->assertEquals($overrideArray['title'], trans('anomaly.theme.test_standard::addon.title'));
        $this->assertEquals($overrideArray['name'], trans('anomaly.theme.test_standard::addon.name'));
    }
}
