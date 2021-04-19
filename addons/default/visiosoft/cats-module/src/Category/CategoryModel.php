<?php namespace Visiosoft\CatsModule\Category;

use Visiosoft\CatsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;

class CategoryModel extends CatsCategoryEntryModel implements CategoryInterface
{
    public function getCat($id)
    {
        return CategoryModel::query()
            ->where('cats_category.id', $id)
            ->whereRaw('deleted_at IS NULL')
            ->first();
    }

    public function getParentCats($id, $type = null, $noMainCat = true)
    {
        $cat = $this->getCat($id);
        $catNames = array();
        $cat_ids = array();
        $catNames[] = $cat->name;
        $cat_ids[] = $cat->id;
        $subCat = $cat->parent_category_id;
        if ($subCat != null) {
            for ($i = 0; $i < 10; $i++) {
                $parCat = $this->getCat($subCat);
                if (isset($parCat)) {
                    if ($parCat->parent_category_id == "") {
                        if ($type == "add_main")
                            $catNames[] = $parCat->name;
                        if ($noMainCat) {
                            break;
                        }
                    }
                    $catNames[] = $parCat->name;
                    $cat_ids[] = $parCat->id;
                    $subCat = $parCat->parent_category_id;
                }
            }
        }
        if ($type == 'category_ids') {
            return CategoryModel::query()
                ->whereIn('cats_category.id', $cat_ids)
                ->whereRaw('deleted_at IS NULL')
                ->orderBy('cats_category.id', 'asc')
                ->get();
        }
        if ($type == "parent_id") {
            $cat_ids = array_reverse($cat_ids);
            return $cat_ids[0];
        }
        return $catNames;
    }

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
