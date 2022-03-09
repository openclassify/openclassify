<?php namespace Anomaly\MultipleFieldType\Command;

use Anomaly\MultipleFieldType\MultipleFieldType;
use Illuminate\Container\Container;


/**
 * Class BuildOptions
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class BuildOptions
{

    /**
     * The field type instance.
     *
     * @var MultipleFieldType
     */
    protected $fieldType;

    /**
     * Create a new BuildOptions instance.
     *
     * @param MultipleFieldType $fieldType
     */
    function __construct(MultipleFieldType $fieldType)
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
        if ($options = $this->fieldType->config('options')) {

            $this->fieldType->setOptions($options);

            return;
        }

        $model   = $this->fieldType->getRelatedModel();
        $handler = $this->fieldType->config('handler', $model->getMultipleFieldTypeOptionsHandler());

        if (!class_exists($handler) && !str_contains($handler, '@')) {
            $handler = array_get($this->fieldType->getHandlers(), $handler);
        }

        if (is_string($handler) && !str_contains($handler, '@')) {
            $handler .= '@handle';
        }

        $container->call($handler, ['fieldType' => $this->fieldType]);
    }
}
