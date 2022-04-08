<?php

class HydratorTest extends TestCase
{

    public function testCanHydrateObject()
    {
        (new \Anomaly\Streams\Platform\Support\Hydrator())->hydrate($object = new HydratorStub(), ['test' => 'foo']);

        $this->assertEquals('foo', $object->getTest());
    }
}

class HydratorStub
{

    protected $test = null;

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }
}