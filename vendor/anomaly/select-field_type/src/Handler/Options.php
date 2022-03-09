<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\Command\ParseOptions;
use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Options
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Options
{

    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     */
    public function handle(SelectFieldType $fieldType, Container $container)
    {
        $options = array_get($fieldType->getConfig(), 'options', []);

        if (is_string($options)) {
            $options = $this->dispatch(new ParseOptions($fieldType, $options));
        }

        if ($options instanceof \Closure) {
            $options = $container->call($options, compact('fieldType'));
        }

        $fieldType->setOptions((array)$options);
    }
}
