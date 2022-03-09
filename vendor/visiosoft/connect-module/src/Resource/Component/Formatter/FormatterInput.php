<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class FormatterInput
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class FormatterInput
{

    /**
     * The formatter defaults.
     *
     * @var FormatterDefaults
     */
    protected $defaults;

    /**
     * The resolver utility.
     *
     * @var FormatterResolver
     */
    protected $resolver;

    /**
     * The formatter normalizer.
     *
     * @var FormatterNormalizer
     */
    protected $normalizer;

    /**
     * Create a new FormatterInput instance.
     *
     * @param FormatterResolver   $resolver
     * @param FormatterDefaults   $defaults
     * @param FormatterNormalizer $normalizer
     */
    public function __construct(
        FormatterResolver $resolver,
        FormatterDefaults $defaults,
        FormatterNormalizer $normalizer
    ) {
        $this->resolver   = $resolver;
        $this->defaults   = $defaults;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the builder's formatter input.
     *
     * @param ResourceBuilder $builder
     */
    public function read(ResourceBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->defaults->defaults($builder);
        $this->normalizer->normalize($builder);
    }
}
