<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Visiosoft\AdvsModule\Adv\Event\ReadySimpleAdvFormFields;
use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;

class SimpleAdvFormFields
{
    public function handle(SimpleAdvFormBuilder $builder, StatusRepositoryInterface $statusRepository)
    {
        $statuses = $statusRepository->all()->pluck('name', 'slug')->all();

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
            'status' => [
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => $statuses,
                    "mode" => "search",
                ]
            ],
            'files',
        ];

        $eventFields = event(new ReadySimpleAdvFormFields($form_fields));

        foreach ($eventFields as $field_array) {
            $form_fields = array_merge($field_array);
        }

        $builder->setFields($form_fields);

    }
}
