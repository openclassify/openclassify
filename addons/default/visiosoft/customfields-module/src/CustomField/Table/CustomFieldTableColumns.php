<?php namespace Visiosoft\CustomfieldsModule\CustomField\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CustomFieldTableColumns
{
    public function handle(CustomFieldTableBuilder $builder)
    {
        $builder->setColumns([
            'parent_category' =>
                [
                    'value' => function (EntryInterface $entry, ParentRepositoryInterface $parentRepository,
                                         CategoryRepositoryInterface $categoryRepository) {

                        $parents = $parentRepository->newQuery()->where('cf_id', $entry->getId())
                            ->get()->pluck('cat_id');

                        $categories_name = array();

                        foreach ($parents as $parent) {
                            if ($category = $categoryRepository->find($parent))
                                $categories_name[] = $category->name;
                        }

                        if (count($categories_name))
                            return implode(',', $categories_name);
                        else
                            return trans('visiosoft.module.customfields::field.all_categories.name');
                    }
                ],
            'name',
            'type']
        );
    }
}
