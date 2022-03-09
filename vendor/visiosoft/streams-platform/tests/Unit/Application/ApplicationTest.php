<?php

use Anomaly\Streams\Platform\Application\Application;

class ApplicationTest extends TestCase
{

    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            Application::class,
            $this->app->make(Application::class)
        );
    }

    public function testCanSetup()
    {
        $application = $this->app->make(Application::class);

        $application
            ->setReference('test')
            ->setup();

        $this->assertEquals('test_', \DB::getTablePrefix());
    }

    public function testCanSetTablePrefix()
    {
        $application = $this->app->make(Application::class);

        $application
            ->setReference('test')
            ->setTablePrefix();

        $this->assertEquals('test_', \DB::getTablePrefix());
    }

    public function testCanSetAndGetReference()
    {
        $application = $this->app->make(Application::class);

        $this->assertEquals('test', $application->setReference('test')->getReference('test'));
    }

    public function testCanReturnTablePrefix()
    {
        $application = $this->app->make(Application::class);

        $this->assertEquals('test_', $application->setReference('test')->tablePrefix());
    }
}
