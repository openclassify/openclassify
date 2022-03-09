<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Listener\Traits\CalculateAdTrait;

class CalculatedTotalForNewAd
{
    use CalculateAdTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(CreatedAd $event)
    {
        $ad_detail = $event->getAdDetail()->toArray();

        $this->calculateAdAction($ad_detail);
    }
}