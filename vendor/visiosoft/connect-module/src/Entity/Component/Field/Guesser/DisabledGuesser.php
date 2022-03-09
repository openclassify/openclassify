<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class DisabledGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class DisabledGuesser
{

    /**
     * Guess the field instructions.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $mode   = $builder->getEntityMode();

        foreach ($fields as &$field) {

            // Guess based on the entity mode if applicable.
            if (in_array((string)$disabled = array_get($field, 'disabled', null), ['create', 'edit'])) {
                $field['disabled'] = $disabled === $mode;
            }
        }

        $builder->setFields($fields);
    }
}
