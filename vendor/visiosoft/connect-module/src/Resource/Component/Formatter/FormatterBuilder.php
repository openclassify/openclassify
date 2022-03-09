<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Support\Value;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class FormatterBuilder
 *

 * @package Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class FormatterBuilder
{

    /**
     * The value interpreter.
     *
     * @var Value
     */
    protected $value;

    /**
     * The formatter reader.
     *
     * @var FormatterInput
     */
    protected $input;

    /**
     * The formatter factory.
     *
     * @var FormatterFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new FormatterBuilder instance.
     *
     * @param Value $value
     * @param FormatterInput $input
     * @param FormatterFactory $factory
     * @param Evaluator $evaluator
     */
    public function __construct(
        Value $value,
        FormatterInput $input,
        FormatterFactory $factory,
        Evaluator $evaluator
    ) {
        $this->input     = $input;
        $this->value     = $value;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the formatters.
     *
     * @param ResourceBuilder $builder
     * @param                 $entry
     * @return FormatterCollection
     */
    public function build(ResourceBuilder $builder, $entry)
    {
        $resource = $builder->getResource();

        $formatters = new FormatterCollection();

        $this->input->read($builder);

        foreach ($builder->getFormatters() as $formatter) {

            array_set($formatter, 'entry', $entry);

            $formatter = $this->evaluator->evaluate($formatter, compact('entry', 'resource'));

            if ($formatter['format'] instanceof Relation) {
                $formatter['format'] = $formatter['format']->getResults();
            }

            if (is_object($formatter['format'])) {
                $formatter['output'] = $formatter['format'];
            }

            if (!is_object($formatter['format'])) {
                $formatter['output'] = $this->value->make($formatter, $entry);
            }

            if ($json = json_decode(stripslashes($formatter['output']))) {
                $formatter['output'] = $json;
            }

            $formatter = $this->factory->make($formatter);

            $formatters->put($formatter->getField(), $formatter);
        }

        return $formatters;
    }
}
