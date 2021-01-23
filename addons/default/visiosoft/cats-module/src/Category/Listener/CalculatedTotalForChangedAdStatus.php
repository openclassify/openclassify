<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Listener\Traits\CalculateAdTrait;

class CalculatedTotalForChangedAdStatus
{
    use CalculateAdTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(ChangedStatusAd $event)
    {
        $ad_detail = $event->getAdDetail()->toArray();

        $this->calculateAdAction($ad_detail);
    }
}