<?php namespace Anomaly\TagsFieldType\Command;

use Anomaly\TagsFieldType\TagsFieldType;
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
     * @var TagsFieldType
     */
    protected $fieldType;

    /**
     * Create a new BuildOptions instance.
     *
     * @param TagsFieldType $fieldType
     */
    function __construct(TagsFieldType $fieldType)
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

        if (is_string($handler) && !str_contains($handler, '@')) {
            $handler .= '@handle';
        }

        $container->call($handler, ['fieldType' => $this->fieldType]);
    }
}
