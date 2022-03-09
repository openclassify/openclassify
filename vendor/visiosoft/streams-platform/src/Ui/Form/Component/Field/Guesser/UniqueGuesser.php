<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class UniqueGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UniqueGuesser
{

    /**
     * Guess the field unique rule.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getFormEntry();

        foreach ($fields as &$field) {
            $unique = array_pull($field, 'rules.unique');

            /*
             * No unique? Continue...
             */
            if (!$unique || $unique === false) {
                continue;
            }

            /*
             * If unique is a string then
             * it's set explicitly.
             */
            if ($unique && is_string($unique)) {
                $field['rules']['unique'] = 'unique:' . $unique;

                continue;
            }

            /*
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

            /*
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
