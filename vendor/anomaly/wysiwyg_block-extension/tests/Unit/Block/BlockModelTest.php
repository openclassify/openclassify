<?php

namespace Anomaly\WysiwygBlockExtension\Test\Unit\Block;

use Anomaly\WysiwygBlockExtension\Block\BlockModel;

/**
 * Class BlockModelTest
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlockModelTest extends \TestCase
{

    public function testCanInstantiate()
    {
        $this->assertInstanceOf(BlockModel::class, $this->app->make(BlockModel::class));
    }
}
