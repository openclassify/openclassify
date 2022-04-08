<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class FieldNormalizer
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field
 */
class FieldNormalizer
{

    /**
     * Normalize the field input.
     *
     * @param ResourceBuilder $builder
     */
    public function normalize(ResourceBuilder $builder)
    {
        $fields = $builder->getFields();

        foreach ($fields as $key => &$field) {

            /**
             * If the key is non-numerical then
             * use it as the header and use the
             * field as the field if it's a class.
             */
            if (!is_numeric($key) && !is_array($field) && class_exists($field)) {
                $field = [
                    'heading' => $key,
                    'field'   => $field,
                ];
            }

            /**
             * If the key is non-numerical then
             * use it as the header and use the
             * field as the value.
             */
            if (!is_numeric($key) && !is_array($field) && !class_exists($field)) {
                $field = [
                    'heading' => $key,
                    'value'   => $field,
                ];
            }

            /**
             * If the field is not already an
             * array then treat it as the value.
             */
            if (!is_array($field)) {
                $field = [
                    'value' => $field,
                ];
            }

            /**
             * If no value wrap is set
             * then use a default.
             */
            array_set($field, 'wrapper', array_get($field, 'wrapper', '{value}'));

            /**
             * If there is no value then use NULL
             */
            array_set($field, 'value', array_get($field, 'value', null));
        }

        $builder->setFields($fields);
    }
}
