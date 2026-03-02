<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class AdvTableButtons
{
    public function handle(AdvTableBuilder $builder)
    {
        $buttons = [
            'status' => [
                'text' => function (EntryInterface $entry) {
                    $text_type = ($entry->getStatus() == 'approved') ? 'decline' : 'approve';
                    return "<font class='hidden-xs-down'>" . trans('visiosoft.module.advs::button.' . $text_type) . "</font>";

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
                            return route('visiosoft.module.advs::edit_adv', [$entry->id]);
                        },
                    ],
                    'fast_edit' => [
                        'href' => '/admin/advs/edit/{entry.id}'
                    ],
                    'change_owner' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'text' => trans('visiosoft.module.advs::button.change_owner'),
                        'href' => 'admin/advs-users/choose/{entry.id}'
                    ],
                    'replicate' => [
                        'text' => 'visiosoft.module.advs::button.replicate'
                    ],
                    'create_configration' => [
                        'text' => trans('visiosoft.module.advs::button.create_configurations'),
                        'href' => route('visiosoft.module.advs::configrations.create') . "?ad={entry.id}"]
                ]
            ]
        ];

        $builder->setButtons($buttons);

        return $buttons;
    }

}
