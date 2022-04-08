<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class UniqueGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Guesser
 */
class UniqueGuesser
{

    /**
     * Guess the field unique rule.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getEntityEntry();

        foreach ($fields as &$field) {

            $unique = array_pull($field, 'rules.unique');

            /**
             * No unique? Continue...
             */
            if (!$unique || $unique === false) {
                continue;
            }

            /**
             * If unique is a string then
             * it's set explicitly.
             */
            if ($unique && is_string($unique)) {

                $field['rules']['unique'] = 'unique:' . $unique;

                continue;
            }

            /**
             * If unique is true then
             * automate the rule.
             */
            if ($unique && $unique === true) {

                $unique = 'unique:' . $entry->getTable() . ',' . $field['field'];

                if ($entry instanceof EntryInterface) {
                    $unique .= ',' . $entry->getId();
                }

                $field['rules']['unique'] = $unique;

                continue;
            }

            /**
             * If unique is an array then use
             * the default automation and add to it.
             */
            if ($unique && is_array($unique)) {

                $unique = 'unique:' . $entry->getTable() . ',' . $field['field'];

                if ($entry instanceof EntryInterface) {
                    $unique .= ',' . $entry->getId();
                }

                $keys   = array_keys($unique);
                $values = array_values($unique);

                foreach ($keys as $column) {
                    $unique .= ',' . $column . ',' . $column . ',' . array_shift($values);
                }

                $field['rules']['unique'] = $unique;

                continue;
            }
        }

        $builder->setFields($fields);
    }
}
