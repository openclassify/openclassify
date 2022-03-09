<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class FieldInput
{

    /**
     * The field filler.
     *
     * @var FieldFiller
     */
    protected $filler;

    /**
     * The field parser.
     *
     * @var FieldParser
     */
    protected $parser;

    /**
     * The field guesser.
     *
     * @var FieldGuesser
     */
    protected $guesser;

    /**
     * The field defaulter.
     *
     * @var FieldDefaults
     */
    protected $defaults;

    /**
     * The resolver utility.
     *
     * @var FieldResolver
     */
    protected $resolver;

    /**
     * The evaluator utility.
     *
     * @var FieldEvaluator
     */
    protected $evaluator;

    /**
     * The field populator.
     *
     * @var FieldPopulator
     */
    protected $populator;

    /**
     * The field normalizer.
     *
     * @var FieldNormalizer
     */
    protected $normalizer;

    /**
     * The field translator.
     *
     * @var FieldTranslator
     */
    protected $translator;

    /**
     * Create a new FieldInput instance.
     *
     * @param FieldFiller     $filler
     * @param FieldParser     $parser
     * @param FieldGuesser    $guesser
     * @param FieldDefaults   $defaults
     * @param FieldResolver   $resolver
     * @param FieldEvaluator  $evaluator
     * @param FieldPopulator  $populator
     * @param FieldNormalizer $normalizer
     * @param FieldTranslator $translator
     */
    public function __construct(
        FieldFiller $filler,
        FieldParser $parser,
        FieldGuesser $guesser,
        FieldDefaults $defaults,
        FieldResolver $resolver,
        FieldEvaluator $evaluator,
        FieldPopulator $populator,
        FieldNormalizer $normalizer,
        FieldTranslator $translator
    ) {
        $this->filler     = $filler;
        $this->parser     = $parser;
        $this->guesser    = $guesser;
        $this->defaults   = $defaults;
        $this->resolver   = $resolver;
        $this->evaluator  = $evaluator;
        $this->populator  = $populator;
        $this->normalizer = $normalizer;
        $this->translator = $translator;
    }

    /**
     * Read the form input.
     *
     * @param FormBuilder $builder
     */
    public function read(FormBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
        $this->evaluator->evaluate($builder);
        $this->defaults->defaults($builder);
        $this->filler->fill($builder);

        $this->normalizer->normalize($builder); //Yes, again.
        $this->guesser->guess($builder);
        $this->parser->parse($builder);

        $this->translator->translate($builder);
        $this->populator->populate($builder);
    }
}
