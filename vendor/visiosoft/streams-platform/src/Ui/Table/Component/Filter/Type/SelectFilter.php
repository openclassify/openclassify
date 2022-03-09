<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SelectFilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Filter;

/**
 * Class SelectFilter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SelectFilter extends Filter implements SelectFilterInterface
{

    /**
     * The field type builder.
     *
     * @var FieldTypeBuilder
     */
    protected $builder;

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * The filter options.
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new SelectFilter instance.
     *
     * @param FieldTypeBuilder $builder
     * @param Resolver         $resolver
     * @param Evaluator        $evaluator
     */
    public function __construct(FieldTypeBuilder $builder, Resolver $resolver, Evaluator $evaluator)
    {
        $this->builder   = $builder;
        $this->resolver  = $resolver;
        $this->evaluator = $evaluator;
    }

    /**
     * Get the input HTML.
     *
     * @return string
     */
    public function getInput()
    {
        $this->resolver->resolve($this->getOptions(), ['filter' => $this]);

        return $this->builder->build(['type' => SelectFieldType::class])
            ->setPlaceholder($this->getPlaceholder())
            ->setField('filter_' . $this->getSlug())
            ->setPrefix($this->getPrefix())
            ->setValue($this->getValue())
            ->mergeConfig(
                [
                    'options' => $this->evaluator->evaluate($this->getOptions(), ['filter' => $this]),
                ]
            )->getFilter();
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param  array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }
}
