<?php namespace Visiosoft\CatsModule\Category\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class CategoryTableButtons
{
    public function handle(CategoryTableBuilder $builder)
    {

        $builder->setButtons([
            'edit' => [
                'href' => '/admin/cats/edit/{entry.id}?parent={entry.parent_category_id}'
            ],
            'add_sub_category' => [
                'icon' => 'fa fa-caret-square-o-down',
                'type' => 'success',
                'href' => '/admin/cats/create?parent={entry.id}'
            ],
            'sub_category' => [
                'icon' => 'fa fa-caret-square-o-down',
                'type' => 'success',
                'href' => '/admin/cats?cat={entry.id}'
            ],
            'convert_main' => [
                'icon' => 'refresh',
                'class' => function () {
                    $class = 'sure-modal';
                    if (!request('cat')) {
                        $class = $class.' hidden';
                    }
                    return $class;
                },
                'type' => 'info',
                'href' => '/admin/cats/convert-main/{entry.id}'
            ],
            'delete' => [
                'icon' => 'fa fa-trash',
                'type' => 'danger',
                'href' => function (EntryInterface $entry) {
                    return route('visiosoft.module.cats::admin.delete_category', ['id' => $entry->getId()]) . "?parent=" . $entry->parent_category_id;
                }
            ]
        ]);
    }
}
