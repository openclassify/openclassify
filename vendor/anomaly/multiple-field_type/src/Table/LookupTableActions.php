<?php namespace Anomaly\MultipleFieldType\Table;


/**
 * Class LookupTableActions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
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
