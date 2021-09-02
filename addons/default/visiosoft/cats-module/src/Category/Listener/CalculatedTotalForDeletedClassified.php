<?php namespace Visiosoft\CatsModule\Category\Listener;

use Visiosoft\ClassifiedsModule\Classified\Event\DeletedClassified;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Listener\Traits\CalculateClassifiedTrait;

class CalculatedTotalForDeletedClassified
{
    use CalculateClassifiedTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(DeletedClassified $event)
    {
        $ad_detail = $event->getClassifiedDetail()->toArray();

        $this->calculateClassifiedAction($ad_detail);
    }
}