<?php namespace Anomaly\RelationshipFieldType\Table;

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
