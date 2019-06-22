<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;

class CategoryPresenter extends EntryPresenter
{
    public function getAdvsListUrl($attributes) {
        return \route('visiosoft.module.advs::list', "cat=".$attributes);
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
        $categories = array();
        $z = 1;
        for($i = 1; $i <= $z; $i++)
        {
            $main = $this->find($id);
            $new = array();
            $new['id'] = $main->id;
            $new['val'] = $this->getname($main->id);
            $categories[] = $new;
            if($main->parent_category_id != null)
            {
                $id = $main->parent_category_id;
                $z++;
            }
        }
        $categories = array_reverse($categories);
        unset($categories[count($categories)-1]);
        return $categories;
    }
}
