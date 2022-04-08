<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PrefixesGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PrefixesGuesser
{

    /**
     * Guess the field placeholders.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $prefix = $builder->getFormOption('prefix');

        foreach ($fields as &$field) {
            array_set($field, 'prefix', array_get($field, 'prefix', $prefix));
        }

        $builder->setFields($fields);
    }
}
