<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class RequiredGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class RequiredGuesser
{

    /**
     * Guess the field required flag.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $mode   = $builder->getEntityMode();
        $entry  = $builder->getEntityEntry();

        foreach ($fields as &$field) {

            // Guess based on the assignment if possible.
            if (
                !isset($field['required'])
                && $entry instanceof EntryInterface
                && $assignment = $entry->getAssignment($field['field'])
            ) {
                $field['required'] = array_get($field, 'required', $assignment->isRequired());
            }

            // Guess based on the entity mode if applicable.
            if (in_array(($required = array_get($field, 'required')), ['create', 'edit'])) {
                $field['required'] = $required === $mode;
            }

            // Guess based on the rules.
            if (in_array('required', array_get($field, 'rules', []))) {
                $field['required'] = true;
            }
        }

        $builder->setFields($fields);
    }
}
