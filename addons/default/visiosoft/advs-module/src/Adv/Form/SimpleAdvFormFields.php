<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Visiosoft\AdvsModule\Adv\Event\ReadySimpleAdvFormFields;

class SimpleAdvFormFields
{
    public function handle(SimpleAdvFormBuilder $builder)
    {
        $form_fields = [
            'name',
            'price',
            'currency',
            'advs_desc',
            'cat1',
            'cat2',
            'cat3',
            'cat4',
            'cat5',
            'cat6',
            'cat7',
            'cat8',
            'cat9',
            'cat10',
            'is_get_adv',
            'stock',
            'files',
        ];

        $eventFields = event(new ReadySimpleAdvFormFields($form_fields));

        foreach ($eventFields as $field_array) {
            $form_fields = array_merge($field_array);
        }

        $builder->setFields($form_fields);

    }
}
