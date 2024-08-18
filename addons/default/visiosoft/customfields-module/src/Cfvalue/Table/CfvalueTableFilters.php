<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Table;

use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\Cfvalue\Table\Filter\CategoryQuery;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CfvalueTableFilters
{
    public function handle(CfvalueTableBuilder $builder)
    {
        $builder->setFilters([
            'custom_field',
            'cat_id' => [
                'placeholder' => trans('visiosoft.module.customfields::field.all_categories.name'),
                'filter' => 'select',
                'query' => CategoryQuery::class,
                'options' => function (ParentRepositoryInterface $parentRepository,
                                       CategoryRepositoryInterface $categoryRepository) {
                    $options = [];
                    foreach ($parentRepository->all() as $item) {
                        if (!isset($options[$item->cat_id])) {
                            if ($category = $categoryRepository->find($item->cat_id)) {
                                $options[$category->getId()] = $category->name;
                            }
                        }
                    }
                    return $options;

                }
            ]
        ]);
    }
}
