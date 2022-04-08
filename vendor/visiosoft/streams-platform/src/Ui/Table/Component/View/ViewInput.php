<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewInput
{

    /**
     * The view lookup.
     *
     * @var ViewLookup
     */
    protected $lookup;

    /**
     * The view guesser.
     *
     * @var ViewGuesser
     */
    protected $guesser;

    /**
     * The view defaults.
     *
     * @var ViewDefaults
     */
    protected $defaults;

    /**
     * The view resolver.
     *
     * @var ViewResolver
     */
    protected $resolver;

    /**
     * The view normalizer.
     *
     * @var ViewNormalizer
     */
    protected $normalizer;

    /**
     * Create a new ViewInput instance.
     *
     * @param ViewLookup     $lookup
     * @param ViewGuesser    $guesser
     * @param ViewDefaults   $defaults
     * @param ViewResolver   $resolver
     * @param ViewNormalizer $normalizer
     */
    public function __construct(
        ViewLookup $lookup,
        ViewGuesser $guesser,
        ViewDefaults $defaults,
        ViewResolver $resolver,
        ViewNormalizer $normalizer
    ) {
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->defaults   = $defaults;
        $this->resolver   = $resolver;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder view input.
     *
     * @param  TableBuilder $builder
     * @return array
     */
    public function read(TableBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->defaults->defaults($builder);
        $this->normalizer->normalize($builder);
        $this->lookup->merge($builder);
        $this->guesser->guess($builder);
    }
}
