<?php namespace Anomaly\DatetimeFieldType\Support;

/**
 * Class DatetimeConverter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeConverter
{

    /**
     * Maps of PHP to JS
     * date symbols. Time
     * has no conversion.
     *
     * @var array
     */
    protected $maps = [
        'default' => [
            // AM/PM
            'A' => 'a',
            // Minute
            'i' => 'M',
            // Hour
            'g' => 'h',
            'G' => 'H',
            'h' => 'h',
            'H' => 'H',
            // Day
            'd' => 'D',
            'D' => 'w',
            'j' => 'd',
            'l' => 'W',
            'z' => 'o',
            // Month
            'F' => 'N',
            'm' => 'O',
            'M' => 'n',
            'n' => 'o',
            // Year
            'Y' => 'Y',
            'y' => 'y',
        ],
        'picker'  => [
            // AM/PM
            'A' => 'K',
            'a' => 'K',
            // Hour
            'g' => 'h',
            'G' => 'H',
            'h' => 'h',
            'H' => 'H',
            // Minute
            'i' => 'i',
            // Day
            'd' => 'd',
            'D' => 'D',
            'j' => 'j',
            'l' => 'l',
            'z' => 'z',
            // Month
            'F' => 'F',
            'm' => 'm',
            'M' => 'M',
            'n' => 'n',
            // Year
            'Y' => 'Y',
            'y' => 'y',
        ],
    ];

    /**
     * Return the PHP equivalent
     * of the provided JS date string.
     *
     * @param $js
     * @param string $map
     * @return string
     */
    public function toPhp($js, $map = 'default')
    {
        return $this->convert($js, array_flip($this->maps[$map]));
    }

    /**
     * Return the JS equivalent
     * of the provided PHP date string.
     *
     * @param        $php
     * @param string $map
     * @return string
     */
    public function toJs($php, $map = 'default')
    {
        return $this->convert($php, $this->maps[$map]);
    }

    /**
     * Convert a string according to a map.
     * @param $string
     * @param array $map
     * @return string
     */
    protected function convert($string, array $map)
    {
        $stack     = '';
        $converted = '';

        /*
         * Add a space at the end so
         * we finish the string.
         */
        $string = str_split($string . ' ');

        for ($i = 0; $i < count($string); $i++) {

            $char = $string[$i];

            // If it's not a valid character we
            // can process the stack.
            if (preg_match('/[^A-Za-z0-9]+/', $char)) {

                $converted .= array_get($map, $stack) . $char;

                $stack = '';

                continue;
            }

            $stack .= $char;
        }

        return trim($converted);
    }
}
