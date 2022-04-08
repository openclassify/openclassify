<?php namespace Anomaly\CheckboxesFieldType;

use Anomaly\CheckboxesFieldType\Command\ParseOptions;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;

class CheckboxesFieldTypeOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param CheckboxesFieldType $fieldType
     */
    public function handle(CheckboxesFieldType $fieldType)
    {
        $options = array_get($fieldType->getConfig(), 'options', []);

        if (is_string($options)) {
            $options = $this->dispatch(new ParseOptions($fieldType, $options));
        }

        if ($options instanceof Collection && $options->isEmpty()) {
            $options = [];
        }

        if ($options instanceof Collection && is_object($first = $options->first())) {
            if ($first instanceof EntryInterface) {
                $value = $first->getTitleName();
            } else {
                $value = 'id';
            }

            $options = $options->pluck($value, 'id');
        }

        if ($options instanceof Collection && is_string($options->first())) {
            $options = $options->all();
        }

        $fieldType->setOptions($options);
    }
}
