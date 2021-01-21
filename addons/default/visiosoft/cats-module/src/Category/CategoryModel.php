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
}
