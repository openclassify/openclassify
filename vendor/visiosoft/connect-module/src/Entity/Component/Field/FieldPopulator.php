<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldPopulator
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldPopulator
{

    /**
     * Populate the fields with entry values.
     *
     * @param EntityBuilder $builder
     */
    public function populate(EntityBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getEntityEntry();

        foreach ($fields as &$field) {

            /**
             * If the field is not already set
             * then get the value off the entry.
             */
            if (!isset($field['value']) && $entry instanceof EloquentModel && $entry->getId()) {
                if ($locale = array_get($field, 'locale')) {
                    $field['value'] = $entry->translateOrDefault($locale)->$field['field'];
                } else {
                    $field['value'] = $entry->$field['field'];
                }
            }

            /**
             * If the field has a default value
             * and the entry does not exist yet
             * then use the default value.
             */
            if (isset($field['config']['default_value']) && $entry instanceof EloquentModel && !$entry->getId()) {
                $field['value'] = $field['config']['default_value'];
            }

            /**
             * If the field has a default value
             * and there is no entry then
             * use the default value.
             */
            if (isset($field['config']['default_value']) && !$entry) {
                $field['value'] = $field['config']['default_value'];
            }

            /**
             * If the field is an assignment then
             * use it's config for the default value.
             */
            if (!isset($field['value']) && $entry instanceof EntryInterface && $type = $entry->getFieldType(
                    $field['field']
                )
            ) {
                $field['value'] = array_get($type->getConfig(), 'default_value');
            }
        }

        $builder->setFields($fields);
    }
}
