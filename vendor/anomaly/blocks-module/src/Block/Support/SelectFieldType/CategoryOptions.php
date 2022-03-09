<?php namespace Anomaly\BlocksModule\Block\Support\SelectFieldType;

use Anomaly\BlocksModule\Block\BlockCategories;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class CategoryOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryOptions
{

    /**
     * Handle the category options.
     *
     * @param SelectFieldType $fieldType
     * @param BlockCategories $categories
     */
    public function handle(SelectFieldType $fieldType, BlockCategories $categories)
    {
        $categories = $categories->getCategories();

        array_pull($categories, 'all');

        $fieldType->setOptions(
            array_combine(
                array_keys($categories),
                array_map(
                    function ($category) {
                        return $category['name'];
                    },
                    $categories
                )
            )
        );
    }

}
