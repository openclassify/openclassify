<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CategoryInterface extends EntryInterface
{
    public function getCat($id);

    public function getParentCats($id, $type = null, $noMainCat = true);

    public function getMetaKeywords();

    public function getMetaDescription();

    public function getParent();

    public function getMains($id);

    public function setCategoryIconUrl($url);

    public function getSubCategories();
}
