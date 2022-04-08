<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class FormatterNormalizer
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class FormatterNormalizer
{

    /**
     * Normalize the format input.
     *
     * @param ResourceBuilder $builder
     */
    public function normalize(ResourceBuilder $builder)
    {
        $formats = $builder->getFormatters();

        foreach ($formats as $field => &$format) {

            /**
             * If the key is non-numerical then
             * use it as the header and use the
             * format as the format if it's a class.
             */
            if (!is_numeric($field) && !is_array($format) && class_exists($format)) {
                $format = [
                    'field'  => $field,
                    'format' => $format,
                ];
            }

            /**
             * If the key is non-numerical then
             * use it as the field and use the
             * format as itself.
             */
            if (!is_numeric($field) && !is_array($format)) {
                $format = [
                    'field'  => $field,
                    'format' => $format,
                ];
            }

            /**
             * If the key is non-numerical and
             * the format is an array without the
             * field present - move the field in.
             */
            if (!is_numeric($field) && is_array($format) && !isset($format['field'])) {
                $format['field'] = $field;
            }

            /**
             * If the format is not already an
             * array then treat it as the value.
             */
            if (!is_array($format)) {
                $format = [
                    'field'  => $format,
                    'format' => $format,
                ];
            }

            /**
             * Make sure the format starts
             * with the entry object.
             */
            if (!str_contains($format['format'], 'entry.')) {
                $format['format'] = 'entry.' . $format['field'] . '.' . $format['format'];
            }

            /**
             * If no value wrap is set
             * then use a default.
             */
            array_set($format, 'wrapper', array_get($format, 'wrapper', '{value}'));

            /**
             * The value interpreter will use this later.
             */
            array_set($format, 'value', array_get($format, 'format'));
        }

        $builder->setFormatters($formats);
    }
}
