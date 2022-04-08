<?php namespace Anomaly\MultipleFieldType\Table;



/**
 * Class LookupTableColumns
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LookupTableColumns
{

    /**
     * Handle the command.
     *
     * @param LookupTableBuilder $builder
     */
    public function handle(LookupTableBuilder $builder)
    {
        $stream = $builder->getTableStream();
        $column = $stream->getTitleColumn();

        if ($column == 'id') {

            $builder->setColumns([]);

            return;
        }

        $builder->setColumns(
            [
                $column,
            ]
        );
    }
}
