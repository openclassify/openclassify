<?php

class ResolverTest extends TestCase
{
    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Resolver::class,
            $this->app->make(\Anomaly\Streams\Platform\Support\Resolver::class)
        );
    }

    public function testCanResolveHandler()
    {
        $resolver = $this->app->make(\Anomaly\Streams\Platform\Support\Resolver::class);

        $this->assertEquals('foo', $resolver->resolve(ResolverStub::class, [], ['method' => 'run']));
    }

    public function testCanResolveCustomHandler()
    {
        $resolver = $this->app->make(\Anomaly\Streams\Platform\Support\Resolver::class);

        $this->assertEquals('foo_test', $resolver->resolve(ResolverStub::class . '@handle', ['prefix' => 'foo_']));
    }
}

class ResolverStub
{
    public function handle($prefix)
    {
        return $prefix . 'test';
    }

    public function run()
    {
        return 'foo';
    }
}
