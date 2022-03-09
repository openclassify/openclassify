<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class WarningsGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WarningsGuesser
{

    /**
     * Guess the field warnings.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $stream = $builder->getFormStream();

        foreach ($fields as &$field) {
            $locale = array_get($field, 'locale');

            /*
             * If the warning is already set then use it.
             */
            if (isset($field['warning'])) {
                if (str_is('*::*', $field['warning'])) {
                    $field['warning'] = trans($field['warning'], [], null, $locale);
                }

                continue;
            }

            /*
             * If we don't have a field then we
             * can not really guess anything here.
             */
            if (!isset($field['field'])) {
                continue;
            }

            /*
             * No stream means we can't
             * really do much here.
             */
            if (!$stream instanceof StreamInterface) {
                continue;
            }

            $assignment = $stream->getAssignment($field['field']);
            $object     = $stream->getField($field['field']);

            /*
             * No assignment means we still do
             * not have anything to do here.
             */
            if (!$assignment) {
                continue;
            }

            /*
             * Next try using the fallback assignment
             * warning system as generated verbatim.
             */
            $warning = $assignment->getWarning() . '.default';

            if (!isset($field['warning']) && str_is('*::*', $warning) && trans()->has($warning, $locale)) {
                $field['warning'] = trans($warning, [], null, $locale);
            }

            /*
             * Next try using the default assignment
             * warning system as generated verbatim.
             */
            $warning = $assignment->getWarning();

            if (
                !isset($field['warning'])
                && str_is('*::*', $warning)
                && trans()->has($warning, $locale)
                && is_string($translated = trans($warning, [], null, $locale))
            ) {
                $field['warning'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['warning']) && $warning && !str_is('*::*', $warning)) {
                $field['warning'] = $warning;
            }

            /*
             * Next try using the default field
             * warning system as generated verbatim.
             */
            $warning = $object->getWarning();

            if (
                !isset($field['warning'])
                && str_is('*::*', $warning)
                && trans()->has($warning, $locale)
                && is_string($translated = trans($warning, [], null, $locale))
            ) {
                $field['warning'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['warning']) && $warning && !str_is('*::*', $warning)) {
                $field['warning'] = $warning;
            }
        }

        $builder->setFields($fields);
    }
}
