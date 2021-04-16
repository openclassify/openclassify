<?php namespace Visiosoft\CatsModule\Category;

use Visiosoft\CatsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;

class CategoryModel extends CatsCategoryEntryModel implements CategoryInterface
{

    public function getMetaKeywords()
    {
        return $this->seo_keyword;
    }

    public function getMetaDescription()
    {
        return $this->seo_description;
    }

    public function getParent()
    {
        return $this->parent_category;
    }
//    public function getMains($id)
//    {
//        $id = $id ?: $this->id;
//
//        $categories = array();
//        $z = 1;
//        for ($i = 1; $i <= $z; $i++) {
//            if ($main = $this->newQuery()->where('id', $id)->first()->select('id', 'name', 'slug', '')) {
//                $categories[] = $main;
//                if ($main->parent_category_id != null) {
//                    $id = $main->parent_category_id;
//                    $z++;
//                }
//            }
//        }
//        $categories = array_reverse($categories);
//        unset($categories[count($categories) - 1]);
//        return $categories;
//    }

    public function getMains($id = null)
    {
        $id = $id ?: $this->id;

        $categories = array();
        $z = 1;
        for ($i = 1; $i <= $z; $i++) {
            if ($main = $this->find($id)) {
                $categories[] = $main;
                if ($main->parent_category_id != null) {
                    $id = $main->parent_category_id;
                    $z++;
                }
            }
        }
        $categories = array_reverse($categories);
        unset($categories[count($categories) - 1]);
        return $categories;
    }

    public function setCategoryIconUrl($url)
    {
        $this->update(['icon' => $url]);
    }

    public function getSubCategories()
    {
        return $this->where('parent_category_id', $this->getId())->get();
    }
}
