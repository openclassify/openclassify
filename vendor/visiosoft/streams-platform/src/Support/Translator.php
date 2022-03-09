<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Translator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Translator
{

    /**
     * Translate a target array.
     *
     * @param  array $target
     * @return array
     */
    public function translate($target)
    {
        if (is_string($target)) {
            return trans($target);
        }

        if (is_array($target)) {
            foreach ($target as &$value) {
                if (is_string($value) && trans()->has($value)) {
                    if (is_string($translated = trans($value))) {
                        $value = $translated;
                    }
                } elseif (is_array($value)) {
                    $value = $this->translate($value);
                }
            }
        }

        return $target;
    }
}
