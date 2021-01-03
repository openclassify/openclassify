<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CategoryInterface extends EntryInterface
{
    public function getCat($id);

    public function getParentCats($id, $type = null);

    public function getCatLevel($id);

    public function getParentsCount($id);

    public function getSubCategories($id, $get = null);

    public function getAllSubCategories($id);

    public function deleteSubCategories($id);

    public function searchKeyword($keyword, $selected = null);

    public function getMainCategory();

    public function getMeta_keywords($cat_id);

    public function getMeta_description($cat_id);

    public function getMeta_title($cat_id);

    public function getMains($id);

    public function getParent();
}
