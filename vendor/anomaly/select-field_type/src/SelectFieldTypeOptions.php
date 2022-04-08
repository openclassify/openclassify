<?php namespace Anomaly\SelectFieldType;

use Anomaly\SelectFieldType\Command\ParseOptions;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SelectFieldTypeOptions
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

        if (is_null($options)) {
            $options = [];
        }

        $fieldType->setOptions($options);
    }
}
