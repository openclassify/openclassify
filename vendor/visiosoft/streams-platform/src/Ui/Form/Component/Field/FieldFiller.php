<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldFiller
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldFiller
{

    /**
     * Fill in fields.
     *
     * @param FormBuilder $builder
     */
    public function fill(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $stream = $builder->getFormStream();

        /*
         * If no Stream, skip it.
         */
        if (!$stream) {
            if (array_search('*', $fields) !== false) {
                unset($fields[array_search('*', $fields)]);

                $builder->setFields($fields);
            }

            return;
        }

        /*
         * Fill with everything by default.
         */
        $fill = $stream->getAssignments()->fieldSlugs();

        /*
         * Loop over field configurations and unset
         * them from the fill fields.
         *
         * If we come across the fill marker then
         * set the position.
         */
        foreach ($fields as $parameters) {
            if (is_string($parameters) && $parameters === '*') {
                continue;
            }

            /**
             * If we found a field then
             * unset it from the fill fields.
             */
            if (($search = array_search($parameters['field'], $fill)) !== false) {
                unset($fill[$search]);
            }
        }

        /*
         * If we have a fill marker then splice
         * in the remaining fill fields in place
         * of the fill marker.
         */
        if (($position = array_search('*', $fields)) !== false) {
            array_splice($fields, $position, null, $fill);

            unset($fields[array_search('*', $fields)]);
        }

        $builder->setFields($fields);
    }
}
