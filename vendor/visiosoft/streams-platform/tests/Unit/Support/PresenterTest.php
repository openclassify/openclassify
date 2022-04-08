<?php

class PresenterTest extends TestCase
{

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Presenter::class,
            new \Anomaly\Streams\Platform\Support\Presenter(new PresenterStub())
        );
    }

    public function testProtectedMethods()
    {
        $presenter = new \Anomaly\Streams\Platform\Support\Presenter(new PresenterStub());

        $this->assertNull($presenter->save());
        $this->assertNull($presenter->update());
        $this->assertNull($presenter->delete());
    }

    public function testCanAccessPublicObjectMethods()
    {
        $presenter = new \Anomaly\Streams\Platform\Support\Presenter(new PresenterStub());

        $this->assertEquals('public', $presenter->public_method);
    }

    public function testCanAccessPublicPresenterMethods()
    {
        $presenter = new \Anomaly\Streams\Platform\Support\Presenter(new PresenterStub());

        $this->assertInstanceOf(PresenterStub::class, $presenter->object);
    }

    public function testCanAccessProtectedObjectPropertiesThroughGetters()
    {
        $presenter = new \Anomaly\Streams\Platform\Support\Presenter(new PresenterStub());

        $this->assertEquals('protected', $presenter->protected_value);
    }
}

class PresenterStub
{

    protected $protected = true;

    protected $protectedValue = 'protected';

    public function isProtected()
    {
        return $this->protected;
    }

    public function getProtectedValue()
    {
        return $this->protectedValue;
    }

    public function publicMethod()
    {
        return 'public';
    }

}
