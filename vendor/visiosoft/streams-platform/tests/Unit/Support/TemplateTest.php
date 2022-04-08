<?php

class TemplateTest extends TestCase
{

    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Template::class,
            $this->app->make(\Anomaly\Streams\Platform\Support\Template::class)
        );
    }

    public function testCanRenderStringTemplate()
    {
        $template = $this->app->make(\Anomaly\Streams\Platform\Support\Template::class);

        $string = '{{ label }}: {{ 10*5 }}';

        $this->assertEquals('test: 50', $template->render($string, ['label' => 'test']));
    }
}
