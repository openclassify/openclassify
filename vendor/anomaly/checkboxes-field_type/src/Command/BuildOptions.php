<?php namespace Anomaly\CheckboxesFieldType\Command;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Illuminate\Container\Container;

class BuildOptions
{

    /**
     * The field type instance.
     *
     * @var CheckboxesFieldType
     */
    protected $fieldType;

    /**
     * Create a new BuildOptions instance.
     *
     * @param CheckboxesFieldType $fieldType
     */
    public function __construct(CheckboxesFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        $handler = array_get($this->fieldType->getConfig(), 'handler');

        if (!class_exists($handler) && !str_contains($handler, '@')) {
            $handler = array_get($this->fieldType->getHandlers(), $handler);
        }

        $container->call($handler, ['fieldType' => $this->fieldType], 'handle');
    }
}
