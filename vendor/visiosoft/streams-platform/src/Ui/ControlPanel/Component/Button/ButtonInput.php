<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

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
     * The resolver utility.
     *
     * @var ButtonResolver
     */
    protected $resolver;

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
     * @param ButtonResolver   $resolver
     * @param ButtonNormalizer $normalizer
     */
    public function __construct(
        ButtonParser $parser,
        ButtonLookup $lookup,
        ButtonGuesser $guesser,
        ButtonResolver $resolver,
        ButtonNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->resolver   = $resolver;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder button input.
     *
     * @param  ControlPanelBuilder $builder
     * @return array
     */
    public function read(ControlPanelBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
        $this->lookup->merge($builder);
        $this->guesser->guess($builder);
        $this->parser->parse($builder);
    }
}
