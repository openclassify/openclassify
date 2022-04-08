<?php namespace Anomaly\SelectFieldType\Command;

use Anomaly\SelectFieldType\SelectFieldType;


/**
 * Class ParseOptions
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ParseOptions
{

    /**
     * The select field type.
     *
     * @var SelectFieldType
     */
    protected $fieldType;

    /**
     * The string options.
     *
     * @var string
     */
    protected $options;

    /**
     * Create a new ParseOptions instance.
     *
     * @param SelectFieldType $fieldType
     * @param $options
     */
    public function __construct(SelectFieldType $fieldType, $options)
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
