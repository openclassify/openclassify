<?php namespace Anomaly\Streams\Platform\Database\Migration\Field;

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class FieldNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldNormalizer
{

    /**
     * Normalize the fields input.
     *
     * @param Migration $migration
     */
    public function normalize(Migration $migration)
    {
        $locale = config('app.fallback_locale');

        $fields = $migration->getFields();

        foreach ($fields as $slug => &$field) {

            /*
             * If the field is a simple string then
             * the $slug is used as is and the field
             * must be the field type.
             */
            if (is_string($field)) {
                $field = ['type' => $field];
            }

            $field['slug']      = array_get($field, 'slug', $slug);
            $field['namespace'] = array_get($field, 'namespace', $migration->contextualNamespace());

            if (!isset($field['type'])) {
                throw new \Exception("The [type] parameter must be defined for \"{$field['slug']}\".");
            }

            /*
             * If any of the translatable items exist
             * in the base array then move them up into
             * the translation array.
             */
            foreach (['name', 'instructions', 'placeholder', 'warning'] as $key) {
                if ($value = array_pull($field, $key)) {
                    $field = array_add($field, $locale . '.' . $key, $value);
                }
            }
        }

        $migration->setFields($fields);
    }
}
