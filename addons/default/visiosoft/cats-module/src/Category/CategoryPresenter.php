<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;

class CategoryPresenter extends EntryPresenter
{
    public function getAdvsListUrl($attributes)
    {
        return \route('visiosoft.module.advs::list', "cat=" . $attributes);
    }

    public function getCategoryName($id)
    {
        $category = $this->find($id);
        return $category->name;
    }

    public function getname($id)
    {
        $cat = CatsCategoryEntryModel::query()->find($id);
        return $cat->name;
    }

    public function getMains($id)
    {
        $category_model = new CategoryModel();
        return $category_model->getMains($id);
    }
}
