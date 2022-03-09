<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PlaceholdersGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PlaceholdersGuesser
{

    /**
     * Guess the field placeholders.
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
             * If the placeholder are already set then use it.
             */
            if (isset($field['placeholder'])) {
                if (str_is('*::*', $field['placeholder'])) {
                    $field['placeholder'] = trans($field['placeholder'], [], null, $locale);
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
            if (!$assignment instanceof AssignmentInterface) {
                continue;
            }

            /*
             * Next try using the fallback assignment
             * placeholder system as generated verbatim.
             */
            $placeholder = $assignment->getPlaceholder() . '.default';

            if (!isset($field['placeholder']) && str_is('*::*', $placeholder) && trans()->has(
                    $placeholder,
                    $locale
                )
            ) {
                $field['placeholder'] = trans($placeholder, [], null, $locale);
            }

            /*
             * Next try using the default assignment
             * placeholder system as generated verbatim.
             */
            $placeholder = $assignment->getPlaceholder();

            if (
                !isset($field['placeholder'])
                && str_is('*::*', $placeholder)
                && trans()->has($placeholder, $locale)
                && is_string($translated = trans($placeholder, [], null, $locale))
            ) {
                $field['placeholder'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['placeholder']) && $placeholder && !str_is('*::*', $placeholder)) {
                $field['placeholder'] = $placeholder;
            }

            /*
             * Next try using the default field
             * placeholder system as generated verbatim.
             */
            $placeholder = $object->getPlaceholder();

            if (
                !isset($field['placeholder'])
                && str_is('*::*', $placeholder)
                && trans()->has($placeholder, $locale)
                && is_string($translated = trans($placeholder, [], null, $locale))
            ) {
                $field['placeholder'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['placeholder']) && $placeholder && !str_is('*::*', $placeholder)) {
                $field['placeholder'] = $placeholder;
            }
        }

        $builder->setFields($fields);
    }
}
