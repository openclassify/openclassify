<?php namespace Visiosoft\CustomfieldsModule\CustomField\Table;

use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Table\Filter\CategoryFilterQuery;
use Visiosoft\CustomfieldsModule\CustomField\Table\Filter\SubCategoryFilterQuery;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CustomFieldTableFilters
{
    public function handle(CustomFieldTableBuilder $builder ,CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->getMainCategories()->pluck('name', 'id')->all();


        $builder->setFilters([
            'type' => [
                'exact' => true,
                'filter' => 'select',
                'options' => function () {
                    return [
                        "checkboxes" => "checkboxes",
                        "decimal" => "decimal",
                        "integer" => "integer",
                        "radio" => "radio",
                        "range" => "range",
                        "select" => "select",
                        "selectdropdown" => "select dropdown",
                        "selecttop" => "select top",
                        "selectrange" => "select range",
                        "selectimage" => "select image",
                        "text" => "text",
                    ];
                }
            ],
            'category' => [
                'exact' => true,
                'filter' => 'select',
                'query' => CategoryFilterQuery::class,
                'options' => $categories,
            ],
            'sub_category' => [
                'exact' => true,
                'filter' => 'select',
                'query' => SubCategoryFilterQuery::class,
            ],
        ]);
    }
}
