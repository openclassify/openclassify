<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldFiller
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldFiller
{

    /**
     * Fill in fields.
     *
     * @param EntityBuilder $builder
     */
    public function fill(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $stream = $builder->getEntityStream();

        /**
         * If no Stream, skip it.
         */
        if (!$stream) {

            if (array_search('*', $fields) !== false) {

                unset($fields[array_search('*', $fields)]);

                $builder->setFields($fields);
            }

            return;
        }

        /**
         * Fill with everything by default.
         */
        $fill = $stream->getAssignments()->fieldSlugs();

        /**
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

            unset($fill[array_search($parameters['field'], $fill)]);
        }

        /**
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
