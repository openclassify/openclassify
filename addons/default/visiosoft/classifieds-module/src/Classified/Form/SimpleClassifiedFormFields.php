<?php namespace Visiosoft\ClassifiedsModule\Classified\Form;

use Visiosoft\ClassifiedsModule\Classified\Event\ReadySimpleClassifiedFormFields;
use Visiosoft\ClassifiedsModule\Status\Contract\StatusRepositoryInterface;

class SimpleClassifiedFormFields
{
    public function handle(SimpleClassifiedFormBuilder $builder, StatusRepositoryInterface $statusRepository)
    {
        $statuses = $statusRepository->all()->pluck('name', 'slug')->all();

        $form_fields = [
            'name',
            'price',
            'currency',
            'classifieds_desc',
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
            'is_get_classified',
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

        $eventFields = event(new ReadySimpleClassifiedFormFields($form_fields));

        foreach ($eventFields as $field_array) {
            $form_fields = array_merge($field_array);
        }

        $builder->setFields($form_fields);

    }
}
