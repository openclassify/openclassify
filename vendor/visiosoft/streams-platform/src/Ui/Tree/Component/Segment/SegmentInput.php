<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class SegmentInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SegmentInput
{

    /**
     * The segment parser.
     *
     * @var SegmentParser
     */
    protected $parser;

    /**
     * The segment defaults.
     *
     * @var SegmentDefaults
     */
    protected $defaults;

    /**
     * The resolver utility.
     *
     * @var SegmentResolver
     */
    protected $resolver;

    /**
     * The segment translator.
     *
     * @var SegmentTranslator
     */
    protected $translator;

    /**
     * The segment normalizer.
     *
     * @var SegmentNormalizer
     */
    protected $normalizer;

    /**
     * Create a new SegmentInput instance.
     *
     * @param SegmentParser     $parser
     * @param SegmentDefaults   $defaults
     * @param SegmentResolver   $resolver
     * @param SegmentTranslator $translator
     * @param SegmentNormalizer $normalizer
     */
    public function __construct(
        SegmentParser $parser,
        SegmentDefaults $defaults,
        SegmentResolver $resolver,
        SegmentTranslator $translator,
        SegmentNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->defaults   = $defaults;
        $this->resolver   = $resolver;
        $this->translator = $translator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the builder's segment input.
     *
     * @param TreeBuilder $builder
     */
    public function read(TreeBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->defaults->defaults($builder);
        $this->normalizer->normalize($builder);
        $this->parser->parse($builder);

        $this->translator->translate($builder);
    }
}
