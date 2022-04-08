<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ButtonInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * The button dropdown utility.
     *
     * @var ButtonDropdown
     */
    protected $dropdown;

    /**
     * The button defaults.
     *
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
     * @param ButtonDropdown   $dropdown
     * @param ButtonResolver   $resolver
     * @param ButtonEvaluator  $evaluator
     * @param ButtonNormalizer $normalizer
     */
    public function __construct(
        ButtonParser $parser,
        ButtonLookup $lookup,
        ButtonGuesser $guesser,
        ButtonDefaults $defaults,
        ButtonDropdown $dropdown,
        ButtonResolver $resolver,
        ButtonEvaluator $evaluator,
        ButtonNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->defaults   = $defaults;
        $this->dropdown   = $dropdown;
        $this->resolver   = $resolver;
        $this->evaluator  = $evaluator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder button input.
     *
     * @param FormBuilder $builder
     */
    public function read(FormBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->evaluator->evaluate($builder);
        $this->defaults->defaults($builder);
        $this->normalizer->normalize($builder);
        $this->dropdown->flatten($builder);
        $this->lookup->merge($builder);
        $this->guesser->guess($builder);
        $this->parser->parse($builder);
        $this->dropdown->build($builder);
    }
}
