<?php

namespace Anomaly\Streams\Platform\Addon\FieldType;

use Illuminate\Support\Str;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Support\Hydrator;

/**
 * Class FieldTypeBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeBuilder
{

    use DispatchesJobs;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    private $hydrator;

    /**
     * The service container.
     *
     * @var Container
     */
    private $container;

    /**
     * The field type collection.
     *
     * @var FieldTypeCollection
     */
    private $fieldTypes;

    /**
     * Handle the command.
     *
     * @param Hydrator            $hydrator
     * @param Container           $container
     * @param FieldTypeCollection $fieldTypes
     */
    public function __construct(Hydrator $hydrator, Container $container, FieldTypeCollection $fieldTypes)
    {
        $this->hydrator   = $hydrator;
        $this->container  = $container;
        $this->fieldTypes = $fieldTypes;
    }

    /**
     * Build a field type.
     *
     * @param  array $parameters
     * @return FieldType
     */
    public function build(array $parameters)
    {
        $type = array_get($parameters, 'type');

        /*
         * Make sure the type
         * parameter has been set.
         */
        if (!is_string($type)) {
            throw new \Exception("The [type] parameter of [" . array_get($parameters, 'field') . "] is required and should be string.");
        }

        /*
         * If the field type is a string and
         * contains some kind of namespace for
         * streams then it's a class path and
         * we can resolve it from the container.
         */
        if (Str::contains($type, '\\') && class_exists($type)) {
            $fieldType = clone ($this->container->make($type));
        }

        /*
         * If the field type is a dot format
         * namespace then we can also resolve
         * the field type from the container.
         */
        if (!isset($fieldType) && str_is('*.*.*', $type)) {
            $fieldType = $this->fieldTypes->get($type);
        }

        /*
         * If we have gotten this far then it's
         * likely a simple slug and we can try
         * returning the first match for the slug.
         */
        if (!isset($fieldType)) {
            $fieldType = $this->fieldTypes->findBySlug($type);
        }

        /*
         * If we don't have a field type let em know.
         */
        if (!$fieldType) {
            throw new \Exception("Field type [$type] not found.");
        }

        $fieldType->mergeRules(array_pull($parameters, 'rules', []));
        $fieldType->mergeConfig(array_pull($parameters, 'config', []));

        $this->hydrator->hydrate($fieldType, $parameters);

        return $fieldType;
    }
}
