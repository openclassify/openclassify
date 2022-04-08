<?php

class EvaluatorTest extends TestCase
{

    public function testCanBeResolved()
    {
        $this->assertInstanceOf(
            \Anomaly\Streams\Platform\Support\Evaluator::class,
            $this->app->make(\Anomaly\Streams\Platform\Support\Evaluator::class)
        );
    }

    public function testCanEvaluateClosures()
    {
        $evaluator = $this->app->make(\Anomaly\Streams\Platform\Support\Evaluator::class);

        $this->assertEquals(
            50,
            $evaluator->evaluate(
                function ($multiplier) {
                    return 5 * $multiplier;
                },
                ['multiplier' => 10]
            )
        );
    }

    public function testCanEvaluateArrays()
    {
        $evaluator = $this->app->make(\Anomaly\Streams\Platform\Support\Evaluator::class);

        $this->assertEquals(
            ['Ryan', ['6\'3"'], 50],
            $evaluator->evaluate(
                [
                    'info.name',
                    [
                        'info.height'
                    ],
                    function ($multiplier) {
                        return 5 * $multiplier;
                    }
                ],
                [
                    'info'       => [
                        'name'   => 'Ryan',
                        'height' => '6\'3"'
                    ],
                    'multiplier' => 10
                ]
            )
        );
    }

    public function testCanEvaluateTraversableStrings()
    {
        $evaluator = $this->app->make(\Anomaly\Streams\Platform\Support\Evaluator::class);

        $this->assertEquals(
            'Ryan',
            $evaluator->evaluate(
                'info.name',
                [
                    'info' => [
                        'name' => 'Ryan'
                    ]
                ]
            )
        );
    }
}
