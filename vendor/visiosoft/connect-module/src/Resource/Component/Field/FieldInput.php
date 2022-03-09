<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class FieldInput
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field
 */
class FieldInput
{

    /**
     * The resolver utility.
     *
     * @var FieldResolver
     */
    protected $resolver;

    /**
     * The field normalizer.
     *
     * @var FieldNormalizer
     */
    protected $normalizer;

    /**
     * Create a new FieldInput instance.
     *
     * @param FieldResolver   $resolver
     * @param FieldNormalizer $normalizer
     */
    public function __construct(FieldResolver $resolver, FieldNormalizer $normalizer)
    {
        $this->resolver   = $resolver;
        $this->normalizer = $normalizer;
    }

    /**
     * Read the builder's field input.
     *
     * @param ResourceBuilder $builder
     */
    public function read(ResourceBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->normalizer->normalize($builder);
    }
}
