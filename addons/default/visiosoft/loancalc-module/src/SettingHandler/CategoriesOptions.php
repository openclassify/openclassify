<?php namespace Visiosoft\LoancalcModule\SettingHandler;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CategoriesOptions
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(CheckboxesFieldType $fieldType)
    {
        $categories = $this->categoryRepository->newQuery()->whereNull('parent_category_id')->get();
        $options = array();
        foreach ($categories as $category) {
            $options[$category->id] = $category->name;
        }
        $fieldType->setOptions($options);
    }

}
