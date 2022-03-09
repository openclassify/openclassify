<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class NavigationInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationInput
{

    /**
     * The navigation sorter.
     *
     * @var NavigationSorter
     */
    protected $sorter;

    /**
     * The navigation resolver.
     *
     * @var NavigationResolver
     */
    protected $resolver;

    /**
     * The navigation evaluator.
     *
     * @var NavigationEvaluator
     */
    protected $evaluator;

    /**
     * The navigation normalizer.
     *
     * @var NavigationNormalizer
     */
    protected $normalizer;

    /**
     * Create a new NavigationInput instance.
     *
     * @param NavigationSorter     $sorter
     * @param NavigationResolver   $resolver
     * @param NavigationEvaluator  $evaluator
     * @param NavigationNormalizer $normalizer
     */
    public function __construct(
        NavigationSorter $sorter,
        NavigationResolver $resolver,
        NavigationEvaluator $evaluator,
        NavigationNormalizer $normalizer
    ) {
        $this->sorter     = $sorter;
        $this->resolver   = $resolver;
        $this->evaluator  = $evaluator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the navigation input.
     *
     * @param ControlPanelBuilder $builder
     */
    public function read(ControlPanelBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->evaluator->evaluate($builder);
        $this->normalizer->normalize($builder);
        $this->sorter->sort($builder);
    }
}
