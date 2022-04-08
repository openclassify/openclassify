<?php namespace Anomaly\MultipleFieldType\Table;



/**
 * Class LookupTableFilters
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LookupTableFilters
{

    /**
     * Handle the command.
     *
     * @param LookupTableBuilder $builder
     */
    public function handle(LookupTableBuilder $builder)
    {
        $stream = $builder->getTableStream();
        $filter = $stream->getTitleColumn();

        if ($filter == 'id') {

            $builder->setFilters([]);

            return;
        }

        $builder->setFilters(
            [
                'search' => [
                    'fields' => [
                        $filter,
                    ],
                ],
            ]
        );
    }
}
