<?php namespace Visiosoft\MultipleFieldType\Table;



class LookupTableButtons
{

    /**
     * Handle the command.
     *
     * @param LookupTableBuilder $builder
     */
    public function handle(LookupTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'add' => [
                    'data-entry' => 'entry.id',
                    'data-key'   => $builder->config('key'),
                ],
            ]
        );
    }
}
