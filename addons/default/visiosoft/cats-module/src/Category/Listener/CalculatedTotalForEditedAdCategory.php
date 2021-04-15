<?php namespace Visiosoft\CatsModule\Category\Listener;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\AdvsModule\Adv\Event\EditedAdCategory;
use Visiosoft\CatsModule\Category\Command\CalculateAdsCount;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CalculatedTotalForEditedAdCategory
{
    use DispatchesJobs;

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
            $this->dispatch(new CalculateAdsCount($category_id));
        }

        //Update New Category Count
        foreach ($category_fields_new as $category_id) {
            $this->dispatch(new CalculateAdsCount($category_id));
        }
    }
}