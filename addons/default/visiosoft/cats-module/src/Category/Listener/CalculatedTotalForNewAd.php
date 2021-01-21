<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CalculatedTotalForNewAd
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(CreatedAd $event)
    {
        $ad_detail = $event->getAdDetail()->toArray();

        $category_fields = preg_grep('/^cat/i', array_keys($ad_detail));
        $category_fields = array_combine($category_fields, $category_fields);

        foreach ($category_fields as $key => $field) {
            $category_fields[$key] = $ad_detail[$key];
        }

        $category_fields = array_filter($category_fields);

        foreach ($category_fields as $category_id) {
            if ($category = $this->categoryRepository->find($category_id)) {
                $category->setAttribute('count', $category->count + 1);
                $category->setAttribute('count_at', now());
                $category->save();
            }
        }
    }
}