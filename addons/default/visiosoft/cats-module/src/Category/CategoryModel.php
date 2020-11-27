<?php namespace Visiosoft\CatsModule\Category;

use Illuminate\Support\Facades\DB;
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

    public function getCatLevel($id)
    {
        //count parent and itself
        return count($this->getParentCats($id)) + 1;
    }

    public function getParentsCount($id)
    {
        $parentCats = array();
        $currentId = $id;
        do {
            $cat = $this->getCat($currentId);
            $catParent = $cat->parent_category_id;
            if ($catParent) {
                $currentId = $catParent;
                $parentCats[] = $catParent;
            }
        } while ($catParent);
        return count($parentCats);
    }

    public function getSubCategories($id, $get = null)
    {
        $sub_categories = $this->where('parent_category_id', $id)->get();
        if ($get == 'id') {
            $list_categories_id = array();
            foreach ($sub_categories as $item_category) {
                $list_categories_id[] = $item_category->id;
            }
            return $list_categories_id;
        }
        return $sub_categories;
    }

    public function getAllSubCategories($id)
    {
        $sub = $this->getSubCategories($id, 'id');
        for ($i = 0; $i <= count($sub) - 1; $i++) {
            $sub = array_merge($sub, $this->getSubCategories($sub[$i], 'id'));
        }
        return $sub;
    }

    public function deleteSubCategories($id)
    {
        $subCategories = $this->getAllSubCategories($id);
        if (count($subCategories)) {
            $this->newQuery()->whereIn('id', $subCategories)->delete();
        }

        return true;
    }

    public function searchKeyword($keyword, $selected = null)
    {
        $data = [];
        $cats = DB::table('cats_category');
        if ($selected != null) {
            if (strpos($selected, "-") !== false) {
                $selected = explode('-', $selected);
                $cats = $cats->whereNotIn('cats_category.id', $selected);
            } else {
                $cats = $cats->where('cats_category.id', '!=', $selected);
            }
        }
        $cats = $cats->where('name', 'like', $keyword . '%')
            ->whereRaw('deleted_at IS NULL');

        $cats = $cats->leftJoin('cats_category_translations', function ($join) {
            $join->on('cats_category.id', '=', 'cats_category_translations.entry_id');
            $join->whereIn('cats_category_translations.locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);//active lang
        });
        $cats = $cats->select('cats_category.*', 'cats_category_translations.name as name');
        $cats = $cats->orderBy('id', 'DESC')
            ->groupBy(['cats_category.id'])
            ->get();
        foreach ($cats as $cat) {
            $link = '';
            $parents = $this->getParentCats($cat->id, null, false);
            krsort($parents);
            foreach ($parents as $key => $parent) {
                if ($key == 0) {
                    $link .= $parent . '';
                } else {
                    $link .= $parent . ' > ';
                }
            }
            $data[] = array(
                'id' => $cat->id,
                'name' => $cat->name,
                'parents' => $link,
                'slug' => $cat->slug
            );
        }
        return $data;
    }

    public function getMainCategory()
    {
        return $this->where('parent_category_id', NULL)->get();
    }

    public function getMeta_keywords($cat_id)
    {
        return $this->find($cat_id)->seo_keyword;
    }

    public function getMeta_description($cat_id)
    {
        return $this->find($cat_id)->seo_description;
    }

    public function getMeta_title($cat_id)
    {
        return $this->find($cat_id)->name;
    }

    public function getMains($id)
    {
        $categories = array();
        $z = 1;
        for ($i = 1; $i <= $z; $i++) {
            $main = $this->newQuery()->where('id', $id)->first();
            $new = array();
            $new['id'] = $main->id;
            $new['val'] = $main->name;
            $new['slug'] = $main->slug;
            $categories[] = $new;
            if ($main->parent_category_id != null) {
                $id = $main->parent_category_id;
                $z++;
            }
        }
        $categories = array_reverse($categories);
        unset($categories[count($categories) - 1]);
        return $categories;
    }

    public function getParent()
    {
        return $this->parent_category;
    }
}
