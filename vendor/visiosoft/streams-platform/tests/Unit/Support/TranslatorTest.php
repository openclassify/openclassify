<?php

class TranslatorTest extends TestCase
{

    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Translator::class,
            $this->app->make(\Anomaly\Streams\Platform\Support\Translator::class)
        );
    }

    public function testCanTranslateStrings()
    {
        $translator = $this->app->make(\Anomaly\Streams\Platform\Support\Translator::class);

        $this->assertEquals('Yes', $translator->translate('streams::misc.yes'));
    }

    public function testCanTranslateArrays()
    {
        $translator = $this->app->make(\Anomaly\Streams\Platform\Support\Translator::class);

        $target = [
            'streams::misc.yes',
            [
                'streams::misc.no'
            ]
        ];

        $this->assertEquals(['Yes', ['No']], $translator->translate($target));
    }
}
