<?php

class ParserTest extends TestCase
{

    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Parser::class,
            $this->app->make(\Anomaly\Streams\Platform\Support\Parser::class)
        );
    }

    public function testCanParseSimpleArray()
    {
        $parser = $this->app->make(\Anomaly\Streams\Platform\Support\Parser::class);

        $test = ['foo' => 'bar'];

        $this->assertEquals('bar', $parser->parse('{test.foo}', compact('test')));
    }

    public function testCanParseNestedArray()
    {
        $parser = $this->app->make(\Anomaly\Streams\Platform\Support\Parser::class);

        $test = ['foo' => ['bar' => 'baz']];

        $this->assertEquals('baz', $parser->parse('{test.foo.bar}', compact('test')));
    }

    public function testCanParseArrayableObjects()
    {
        $parser = $this->app->make(\Anomaly\Streams\Platform\Support\Parser::class);

        $object = new ParserStub();

        $test = ['foo' => ['bar' => 'baz']];

        $this->assertEquals('green', $parser->parse('{object.color}', compact('object', 'test')));
    }

    public function testCanParseAnArrayOfTargets()
    {
        $parser = $this->app->make(\Anomaly\Streams\Platform\Support\Parser::class);

        $object = new ParserStub();

        $test = ['foo' => ['bar' => 'baz']];

        $this->assertEquals(
            ['green', 'baz'],
            $parser->parse(['{object.color}', '{test.foo.bar}'], compact('object', 'test'))
        );
    }
}

class ParserStub implements \Illuminate\Contracts\Support\Arrayable
{

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'color' => 'green'
        ];
    }
}
