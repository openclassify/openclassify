<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Visiosoft\CatsModule\Category\CategoryModel;
use function foo\func;

class AdvTableColumns
{

    public function handle(AdvTableBuilder $builder)
    {
        $builder->setColumns([
            'cover_photo' => [
                'value' => function (EntryInterface $entry) {
                    return "<img width='80px' src='" . $entry->AddAdsDefaultCoverImage($entry)->cover_photo . "' >";
                },
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
        ]);
    }

}
