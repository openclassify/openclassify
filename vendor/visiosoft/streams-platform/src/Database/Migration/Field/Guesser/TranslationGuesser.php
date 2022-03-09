<?php namespace Anomaly\Streams\Platform\Database\Migration\Field\Guesser;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class TranslationGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TranslationGuesser
{

    /**
     * Guess the field names.
     *
     * @param Migration $migration
     */
    public function guess(Migration $migration)
    {

        /**
         * If we don't have any addon then
         * we can't automate anything.
         *
         * @var Addon $addon
         */
        if (!$addon = $migration->getAddon()) {
            return;
        }

        $locale = config('app.fallback_locale');

        $fields = $migration->getFields();

        foreach ($fields as &$field) {
            foreach (['name', 'warning', 'instructions', 'placeholder'] as $key) {
                if (is_null(array_get($field, $locale . '.' . $key))) {
                    $field = array_add(
                        $field,
                        $locale . '.' . $key,
                        $addon->getNamespace('field.' . array_get($field, 'slug') . '.' . $key)
                    );
                }
            }
        }

        $migration->setFields($fields);
    }
}
