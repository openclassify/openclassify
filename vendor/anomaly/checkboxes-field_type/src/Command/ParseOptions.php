<?php namespace Anomaly\CheckboxesFieldType\Command;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

class ParseOptions
{

    /**
     * The string options.
     *
     * @var string
     */
    protected $options;

    /**
     * The field type instance.
     *
     * @var CheckboxesFieldType
     */
    protected $fieldType;

    /**
     * Create a new ParseOptions instance.
     *
     * @param CheckboxesFieldType $fieldType
     * @param $options
     */
    public function __construct(CheckboxesFieldType $fieldType, $options)
    {

        $this->options   = $options;
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @return array
     */
    public function handle()
    {
        $options = [];

        $group = null;

        if (!$separator = trim($this->fieldType->config('separator', ':'))) {
            $separator = ':';
        }

        foreach (explode("\n", $this->options) as $option) {

            // Find option [groups]
            if (starts_with($option, '[')) {

                $group = trans(substr(trim($option), 1, -1));

                $options[$group] = [];

                continue;
            }

            // Split on the first ":"
            if (str_is('*' . $separator . '*', $option)) {
                $option = explode($separator, $option, 2);
            } else {
                $option = [$option, $option];
            }

            $key   = ltrim(trim(array_shift($option)));
            $value = ltrim(trim($option ? array_shift($option) : $key));

            if ($group) {
                $options[$group][$key] = $value;
            } else {
                $options[$key] = $value;
            }
        }

        return $options;
    }
}
