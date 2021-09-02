<?php namespace Visiosoft\ClassifiedsModule\Classified\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class ClassifiedTableButtons
{
    public function handle(ClassifiedTableBuilder $builder)
    {
        $buttons = [
            'status' => [
                'text' => function (EntryInterface $entry) {
                    $text_type = ($entry->getStatus() == 'approved') ? 'decline' : 'approve';
                    return "<font class='hidden-xs-down'>" . trans('visiosoft.module.classifieds::button.' . $text_type) . "</font>";

                },
                'icon' => function (EntryInterface $entry) {
                    return ($entry->getStatus() == 'approved') ? "fa fa-eye-slash" : "fa fa-eye";
                },
                'href' => function (EntryInterface $entry) {
                    $action_type = ($entry->getStatus() == 'approved') ? 'declined' : 'approved';
                    return "/admin/class/actions/{entry.id}/" . $action_type;
                },
                'type' => function (EntryInterface $entry) {
                    return ($entry->getStatus() == 'approved') ? "danger" : "success";
                },
            ],
            'settings' => [
                'text' => false,
                'href' => false,
                'dropdown' => [
                    'edit' => [
                        'icon' => null,
                        'href' => function (EntryInterface $entry) {
                            return route('visiosoft.module.classifieds::edit_classified', [$entry->id]);
                        },
                    ],
                    'fast_edit' => [
                        'href' => '/admin/classifieds/edit/{entry.id}'
                    ],
                    'change_owner' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'text' => trans('visiosoft.module.classifieds::button.change_owner'),
                        'href' => 'admin/classifieds-users/choose/{entry.id}'
                    ],
                    'replicate' => [
                        'text' => 'visiosoft.module.classifieds::button.replicate'
                    ],
                    'create_configration' => [
                        'text' => trans('visiosoft.module.classifieds::button.create_configurations'),
                        'href' => route('visiosoft.module.classifieds::configrations.create') . "?classified={entry.id}"]
                ]
            ]
        ];

        $builder->setButtons($buttons);

        return $buttons;
    }

}
