<?php namespace Visiosoft\ConnectModule\Resource\Component\Result;

use Visiosoft\ConnectModule\Resource\Component\Formatter\FormatterBuilder;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class ResultBuilder
 *

 */
class ResultBuilder
{

    /**
     * The formatter builder.
     *
     * @var FormatterBuilder
     */
    protected $formatters;

    /**
     * The result factory.
     *
     * @var ResultFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ResultBuilder instance.
     *
     * @param ResultFactory    $factory
     * @param FormatterBuilder $formatters
     * @param Evaluator        $evaluator
     */
    public function __construct(ResultFactory $factory, FormatterBuilder $formatters, Evaluator $evaluator)
    {
        $this->factory    = $factory;
        $this->formatters = $formatters;
        $this->evaluator  = $evaluator;
    }

    /**
     * Build the results.
     *
     * @param ResourceBuilder $builder
     */
    public function build(ResourceBuilder $builder)
    {
        foreach ($builder->getResourceEntries() as $entry) {

            $formatters = $this->formatters->build($builder, $entry);

            $result = compact('formatters', 'entry');

            $result['resource'] = $builder->getResource();

            $result = $this->evaluator->evaluate($result, compact('builder', 'entry'));

            $builder->addResourceResult($this->factory->make($result));
        }
    }
}
