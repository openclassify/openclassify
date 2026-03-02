<?php namespace Visiosoft\MultipleFieldType\Table;


class LookupTableActions
{

    /**
     * Handle the command.
     *
     * @param LookupTableBuilder $builder
     */
    public function handle(LookupTableBuilder $builder)
    {
        $builder->setActions(
            [
                'add_selected' => [
                    'data-key' => $builder->config('key'),
                ],
            ]
        );
    }
}
