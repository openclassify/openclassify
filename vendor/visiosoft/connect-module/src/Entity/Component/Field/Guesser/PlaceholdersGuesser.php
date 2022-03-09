<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class PlaceholdersGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class PlaceholdersGuesser
{

    /**
     * Guess the field placeholders.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $stream = $builder->getEntityStream();

        foreach ($fields as &$field) {

            /**
             * If the placeholder is already set then use it.
             */
            if (isset($field['placeholder'])) {
                continue;
            }

            /**
             * If we don't have a field then we
             * can not really guess anything here.
             */
            if (!isset($field['field'])) {
                continue;
            }

            /**
             * No stream means we can't
             * really do much here.
             */
            if (!$stream instanceof StreamInterface) {
                continue;
            }

            $assignment = $stream->getAssignment($field['field']);

            /**
             * No assignment means we still do
             * not have anything to do here.
             */
            if (!$assignment instanceof AssignmentInterface) {
                continue;
            }

            /**
             * Try using the assignment placeholder if available
             * otherwise use the field name as the placeholder.
             */
            if (trans()->has($placeholder = $assignment->getPlaceholder(), array_get($field, 'locale'))) {
                $field['placeholder'] = trans($placeholder, [], null, array_get($field, 'locale'));
            } elseif ($placeholder && !str_is('*.*.*::*', $placeholder)) {
                $field['placeholder'] = $placeholder;
            }
        }

        $builder->setFields($fields);
    }
}
