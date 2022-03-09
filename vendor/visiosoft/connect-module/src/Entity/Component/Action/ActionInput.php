<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionInput
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionInput
{

    /**
     * The action parser.
     *
     * @var ActionParser
     */
    protected $parser;

    /**
     * The action lookup.
     *
     * @var ActionLookup
     */
    protected $lookup;

    /**
     * The action guesser.
     *
     * @var ActionGuesser
     */
    protected $guesser;

    /**
     * The resolver utility.
     *
     * @var ActionResolver
     */
    protected $resolver;

    /**
     * The action defaults utility.
     *
     * @var ActionDefaults
     */
    protected $defaults;

    /**
     * The action predictor.
     *
     * @var ActionPredictor
     */
    protected $predictor;

    /**
     * The action normalizer.
     *
     * @var ActionNormalizer
     */
    protected $normalizer;

    /**
     * Create an ActionInput instance.
     *
     * @param ActionParser     $parser
     * @param ActionLookup     $lookup
     * @param ActionGuesser    $guesser
     * @param ActionResolver   $resolver
     * @param ActionDefaults   $defaults
     * @param ActionPredictor  $predictor
     * @param ActionNormalizer $normalizer
     */
    function __construct(
        ActionParser $parser,
        ActionLookup $lookup,
        ActionGuesser $guesser,
        ActionResolver $resolver,
        ActionDefaults $defaults,
        ActionPredictor $predictor,
        ActionNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->resolver   = $resolver;
        $this->defaults   = $defaults;
        $this->predictor  = $predictor;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder action input.
     *
     * @param EntityBuilder $builder
     */
    public function read(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->defaults->defaults($builder);
        $this->predictor->predict($builder);
        $this->normalizer->normalize($builder);
        $this->guesser->guess($builder);
        $this->lookup->merge($builder);
        $this->parser->parse($builder);
    }
}
