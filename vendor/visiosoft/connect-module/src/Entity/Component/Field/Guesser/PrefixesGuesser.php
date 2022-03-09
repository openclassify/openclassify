<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class PrefixesGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class PrefixesGuesser
{

    /**
     * Guess the field placeholders.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $prefix = $builder->getEntityOption('prefix');

        foreach ($fields as &$field) {
            array_set($field, 'prefix', array_get($field, 'prefix', $prefix));
        }

        $builder->setFields($fields);
    }
}
