<?php namespace Visiosoft\NotificationsModule\Template\Table;

use Anomaly\Streams\Platform\Entry\EntryModel;

class TemplateTableColumns
{
    public function handle(TemplateTableBuilder $builder)
    {
        $builder->setColumns([
            'subject',
            'name',
            'enabled' => [
                'value' => function (EntryModel $entry) {
                    $icon = ($entry->enabled) ? 'fa-check' : 'fa-times';
                    return '<i class="fa ' . $icon.'"></i>';
                }
            ],
        ]);
    }
}
