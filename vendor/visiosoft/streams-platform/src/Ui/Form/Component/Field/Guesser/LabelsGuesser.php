<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LabelsGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LabelsGuesser
{

    /**
     * Guess the field labels.
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
             * If the label are already set then use it.
             */
            if (isset($field['label'])) {
                if (str_is('*::*', $field['label'])) {
                    $field['label'] = trans($field['label'], [], null, $locale);
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
             * label system as generated verbatim.
             */
            $label = $assignment->getLabel() . '.default';

            if (!isset($field['label']) && str_is('*::*', $label) && trans()->has(
                    $label,
                    $locale
                )
            ) {
                $field['label'] = trans($label, [], null, $locale);
            }

            /*
             * Next try using the default assignment
             * label system as generated verbatim.
             */
            $label = $assignment->getLabel();

            if (
                !isset($field['label'])
                && str_is('*::*', $label)
                && trans()->has($label, $locale)
                && is_string($translated = trans($label, [], null, $locale))
            ) {
                $field['label'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['label']) && $label && !str_is('*::*', $label)) {
                $field['label'] = $label;
            }

            /*
             * Next try using the generic assignment
             * label system without the stream identifier.
             */
            $label = explode('.', $assignment->getLabel());

            array_pop($label);

            $label = implode('.', $label);

            if (
                !isset($field['label'])
                && str_is('*::*', $label)
                && trans()->has($label, $locale)
                && is_string($translated = trans($label, [], null, $locale))
            ) {
                $field['label'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['label']) && $label && !str_is('*::*', $label)) {
                $field['label'] = $label;
            }

            /*
             * Next try using the default field
             * label system as generated verbatim.
             */
            $label = $object->getName();

            if (
                !isset($field['label'])
                && str_is('*::*', $label)
                && trans()->has($label, $locale)
                && is_string($translated = trans($label, [], null, $locale))
            ) {
                $field['label'] = $translated;
            }

            /*
             * Check if it's just a standard string.
             */
            if (!isset($field['label']) && $label && !str_is('*::*', $label)) {
                $field['label'] = $label;
            }

            /*
             * If the field is still untranslated and
             * we're not debugging then humanize the slug
             * in leu of displaying an untranslated key.
             */
            if (!isset($field['label']) && config('streams::system.lazy_translations')) {
                $field['label'] = ucwords(humanize($field['field']));
            }
        }

        $builder->setFields($fields);
    }
}
