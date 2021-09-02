<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\ClassifiedsModule\Classified\Event\ChangedStatusClassified;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Listener\Traits\CalculateClassifiedTrait;

class CalculatedTotalForChangedClassifiedStatus
{
    use CalculateClassifiedTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(ChangedStatusClassified $event)
    {
        $ad_detail = $event->getClassifiedDetail()->toArray();

        $this->calculateClassifiedAction($ad_detail);
    }
}