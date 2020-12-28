<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Visiosoft\CatsModule\Category\CategoryModel;

class AdvTableColumns
{

    public function handle(AdvTableBuilder $builder)
    {
        $columns = [
            'cover_photo' => [
                'value' => function (EntryInterface $entry) {
                    return "<img width='80px' src='" . $entry->AddAdsDefaultCoverImage($entry)->cover_photo . "' >";
                }
            ],

            'name' => [
                'sort_column' => 'slug',
                'wrapper' => '
                    <strong><span class="text-muted">#{value.id}</span>{value.name}</strong>
                    <br>
                    <small class="text-muted">{value.finish_at}</small>
                    <br>
                    <span>{value.category}</span>',
                'value' => [
                    'id' => 'entry.id',
                    'finish_at' => 'entry.finish_at',
                    'name' => function (EntryInterface $entry) {
                        if ($entry->getTitle()) {
                            $value = "<a href='" . $entry->getAdvDetailLinkByModel($entry, 'list') . "' > {entry.name}</a > ";
                        } else {
                            $value = "<font color='red'>" . trans("visiosoft.module.advs::view.unfinished") . "</font>";
                        }
                        return $value;
                    },
                    'category' => function (EntryInterface $entry, CategoryModel $categoryModel) {
                        $category = $categoryModel->getCat($entry->cat1);
                        if (!is_null($category))
                            return $category->name;
                    }
                ],
            ],
            'price' => [
                'wrapper' => '{{currency_format("{entry.price}","{entry.currency}")}}',
                'class' => 'advs-price',
            ],

            'country' => [
                'class' => 'text-center',
                'wrapper' => '<strong><span class="text-muted">{value.city}</span><br>{value.country}</strong>',
                'value' => [
                    'city' => function (EntryInterface $entry) {
                        return $entry->getCity();
                    },
                    'country' => 'country',
                ]
            ],
            'created_by' => [
                'value' => 'entry.created_by.name',
            ],
        ];

        if ($builder->isActiveView('advanced')) {

            unset($columns['created_by'], $columns['country']);
            $columns['is_get_adv'] = [
                'attributes' => [
                    'html' => function (EntryModel $entry) {
                        $checked = ($entry->is_get_adv) ? 'checked' : '';
                        return '<input style="min-width:120px" type="checkbox" class="form-control fast-update" ' . $checked . ' data-column="is_get_adv" data-entry_id="' . $entry->getId() . '">';
                    }
                ],
                'class' => 'advs-price',
            ];
            $columns['standard_price'] = [
                'attributes' => [
                    'html' => function (EntryModel $entry) {
                        return '<input style="min-width:120px" type="number" min="0" class="form-control fast-update" value="' . $entry->standard_price . '" data-column="standard_price" data-entry_id="' . $entry->getId() . '">';
                    }
                ],
                'class' => 'advs-price',
            ];
            $columns['price']['attributes'] = [
                'html' => function (EntryModel $entry) {
                    return '<input style="min-width:120px" type="number" min="0" class="form-control fast-update" value="' . $entry->price . '" data-column="price" data-entry_id="' . $entry->getId() . '">';
                }
            ];
        }

        $builder->setColumns($columns);
    }

}
