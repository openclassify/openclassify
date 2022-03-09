<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class TranslatableGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class TranslatableGuesser
{

    /**
     * Guess the field instructions.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getEntityEntry();

        if (!is_object($entry)) {
            return;
        }

        foreach ($fields as &$field) {
            $field['translatable'] = $entry->isTranslatedAttribute($field['field']);
        }

        $builder->setFields($fields);
    }
}
