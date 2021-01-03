<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryCollection;

class CategoryCollection extends EntryCollection
{

    public function mainCategories()
    {
        return $this->filter(
            function ($category) {
                return (is_null($category->parent_category_id));
            }
        );
    }
}
