<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FilterInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilterInput
{

    /**
     * The filter lookup.
     *
     * @var FilterLookup
     */
    protected $lookup;

    /**
     * The filter guesser.
     *
     * @var FilterGuesser
     */
    protected $guesser;

    /**
     * The resolver utility.
     *
     * @var FilterResolver
     */
    protected $resolver;

    /**
     * The filter normalizer.
     *
     * @var FilterNormalizer
     */
    protected $normalizer;

    /**
     * Create a new FilterInput instance.
     *
     * @param FilterLookup     $lookup
     * @param FilterGuesser    $guesser
     * @param FilterResolver   $resolver
     * @param FilterNormalizer $normalizer
     */
    public function __construct(
        FilterLookup $lookup,
        FilterGuesser $guesser,
        FilterResolver $resolver,
        FilterNormalizer $normalizer
    ) {
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->resolver   = $resolver;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the builder's filter input.
     *
     * @param  TableBuilder $builder
     */
    public function read(TableBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
        $this->lookup->merge($builder);
        $this->guesser->guess($builder);
    }
}
