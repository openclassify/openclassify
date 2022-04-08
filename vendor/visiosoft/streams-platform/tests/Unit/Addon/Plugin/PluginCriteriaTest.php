<?php

class PluginCriteriaTest extends TestCase
{

    public function testConstructor()
    {
        $criteria = new \Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria(
            'fire',
            function (Anomaly\Streams\Platform\Support\Collection $options) {
                return $options->get('test_option', 'test');
            }
        );

        $this->assertInstanceOf(\Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria::class, $criteria);
    }

    public function testCanFireTrigger()
    {
        $criteria = new \Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria(
            'fire',
            function (Anomaly\Streams\Platform\Support\Collection $options) {
                return $options->get('test_option', 'test');
            }
        );

        $this->assertEquals('test', $criteria->fire());
    }

    public function testCanDynamicallySetOptions()
    {
        $criteria = (
        new \Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria(
            'fire',
            function (Anomaly\Streams\Platform\Support\Collection $options) {
                return $options->get('test_option', 'test');
            }
        )
        )->testOption('foo');

        $this->assertEquals('foo', $criteria->fire());
    }

    public function testCanReturnOptionValue()
    {
        $criteria = (
        new \Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria(
            'fire',
            function (Anomaly\Streams\Platform\Support\Collection $options) {
                return $options->get('test_option', 'test');
            }
        )
        )->testOption('foo');

        $this->assertEquals('foo', $criteria->option('test_option'));
    }
}
