<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CfvalueTableColumns
{
    public function handle(CfvalueTableBuilder $builder)
    {
        $builder->setColumns([
            'custom_field',
            'category' => [
                'value' => function (EntryInterface $entry, ParentRepositoryInterface $parentRepository,
                                     CategoryRepositoryInterface $categoryRepository) {
                    if (count($categories = $parentRepository->findAllBy('cf_id', $entry->custom_field_id))) {
                        $categories_name = array();
                        foreach ($categories as $category) {
                            if ($category = $categoryRepository->find($category->cat_id)) {
                                $categories_name[] = $category->name;
                            }
                        }
                        return implode(', ', $categories_name);
                    } else
                        return trans('visiosoft.module.customfields::field.all');
                }
            ],
            'custom_field_value'
        ]);
    }
}
