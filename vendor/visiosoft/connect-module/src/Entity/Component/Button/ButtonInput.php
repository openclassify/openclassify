<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonInput
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button
 */
class ButtonInput
{

    /**
     * The button parser.
     *
     * @var ButtonParser
     */
    protected $parser;

    /**
     * The button lookup.
     *
     * @var ButtonLookup
     */
    protected $lookup;

    /**
     * The button guesser.
     *
     * @var ButtonGuesser
     */
    protected $guesser;

    /**
     * @var ButtonDefaults
     */
    protected $defaults;

    /**
     * The resolver utility.
     *
     * @var ButtonResolver
     */
    protected $resolver;

    /**
     * The button evaluator.
     *
     * @var ButtonEvaluator
     */
    protected $evaluator;

    /**
     * The button normalizer.
     *
     * @var ButtonNormalizer
     */
    protected $normalizer;

    /**
     * Create a new ButtonInput instance.
     *
     * @param ButtonParser     $parser
     * @param ButtonLookup     $lookup
     * @param ButtonGuesser    $guesser
     * @param ButtonDefaults   $defaults
     * @param ButtonResolver   $resolver
     * @param ButtonEvaluator  $evaluator
     * @param ButtonNormalizer $normalizer
     */
    public function __construct(
        ButtonParser $parser,
        ButtonLookup $lookup,
        ButtonGuesser $guesser,
        ButtonDefaults $defaults,
        ButtonResolver $resolver,
        ButtonEvaluator $evaluator,
        ButtonNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->defaults   = $defaults;
        $this->resolver   = $resolver;
        $this->evaluator  = $evaluator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder button input.
     *
     * @param EntityBuilder $builder
     */
    public function read(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->evaluator->evaluate($builder);
        $this->defaults->defaults($builder);
        $this->normalizer->normalize($builder);
        $this->lookup->merge($builder);
        $this->parser->parse($builder);
        $this->guesser->guess($builder);
    }
}
