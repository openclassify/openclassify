<?php namespace Visiosoft\AdvsModule\Status\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class StatusTableColumns
{
    public function handle(StatusTableBuilder $builder)
    {
        $yes = trans('visiosoft.module.advs::field.yes.name');
        $no = trans('visiosoft.module.advs::field.no.name');

        $columns = [
            'name',
            'is_system' => [
                'value' => function (EntryInterface $entry) use ($yes, $no) {
                    return $entry->is_system ? $yes : $no;
                }
            ],
            'user_access' => [
                'value' => function (EntryInterface $entry) use ($yes, $no) {
                    return $entry->user_access ? $yes : $no;
                }
            ],
        ];

        $builder->setColumns($columns);
    }
}
