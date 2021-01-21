<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\AdvsModule\Adv\Event\EditedAdCategory;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CalculatedTotalForEditedAdCategory
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(EditedAdCategory $event)
    {
        $ad_detail = $event->getAdDetail()->toArray();
        $before_editing_ad = $event->getBeforeEditingParams();

        //Categories New Ad
        $category_fields_new_ad = preg_grep('/^cat/i', array_keys($ad_detail));
        $category_fields_new_ad = array_combine($category_fields_new_ad, $category_fields_new_ad);

        foreach ($category_fields_new_ad as $key => $field) {
            $category_fields_new_ad[$key] = $ad_detail[$key];
        }
        $category_fields_new = array_filter($category_fields_new_ad);

        //Categories Before Editing Ad
        $category_fields_old_ad = preg_grep('/^cat/i', array_keys($before_editing_ad));
        $category_fields_old_ad = array_combine($category_fields_old_ad, $category_fields_old_ad);

        foreach ($category_fields_old_ad as $key => $field) {
            $category_fields_old_ad[$key] = $before_editing_ad[$key];
        }
        $category_fields_old = array_filter($category_fields_old_ad);

        //Update previous category Count
        foreach ($category_fields_old as $category_id) {
            if ($category = $this->categoryRepository->find($category_id)) {
                $category->setAttribute('count', $category->count - 1);
                $category->setAttribute('count_at', now());
                $category->save();
            }
        }

        //Update New Category Count
        foreach ($category_fields_new as $category_id) {
            if ($category = $this->categoryRepository->find($category_id)) {
                $category->setAttribute('count', $category->count + 1);
                $category->setAttribute('count_at', now());
                $category->save();
            }
        }
    }
}