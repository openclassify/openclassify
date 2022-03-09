<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class TranslatableGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TranslatableGuesser
{

    /**
     * Guess the field instructions.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getFormEntry();

        if (!is_object($entry)) {
            return;
        }

        if (!$entry instanceof EloquentModel) {
            return;
        }
        
        foreach ($fields as &$field) {
            $field['translatable'] = $entry->isTranslatedAttribute($field['field']);
        }

        $builder->setFields($fields);
    }
}
