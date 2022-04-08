<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldTranslator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTranslator
{

    /**
     * Translate form fields.
     *
     * @param FormBuilder $builder
     */
    public function translate(FormBuilder $builder)
    {
        $translations = [];

        $defaultLocale  = config('streams::locales.default');
        $enabledLocales = config('streams::locales.enabled');

        /*
         * For each field if the assignment is translatable
         * then duplicate it and set a couple simple
         * parameters to assist in rendering.
         */
        foreach ($builder->getFields() as $field) {

            if (!array_get($field, 'translatable', false)) {

                $translations[] = $field;

                continue;
            }

            if (isset($field['locale'])) {

                array_set($field, 'hidden', $field['locale'] !== $defaultLocale);

                if ($field['locale'] !== $defaultLocale) {
                    array_set($field, 'hidden', true);
                    array_set($field, 'required', false);
                    array_set($field, 'rules', array_diff(array_get($field, 'rules', []), ['required']));
                }

                $translations[] = $field;

                continue;
            }

            foreach ($enabledLocales as $locale) {

                $translation = $field;

                array_set($translation, 'locale', $locale);
                array_set($translation, 'hidden', array_get($field, 'hidden', false) ?: ($locale !== $locale));

                if ($value = array_get($field, 'values.' . $locale)) {
                    array_set($translation, 'value', $value);
                }

                if (config('app.locale', $defaultLocale) !== $locale) {
                    array_set($translation, 'hidden', true);
                    array_set($translation, 'required', false);
                    array_set($translation, 'rules', array_diff(array_get($translation, 'rules', []), ['required']));
                }

                $translations[] = $translation;
            }
        }

        $builder->setFields($translations);
    }
}
