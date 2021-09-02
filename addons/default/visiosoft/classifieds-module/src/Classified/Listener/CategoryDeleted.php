<?php namespace Visiosoft\ClassifiedsModule\Classified\Listener;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\CatsModule\Category\Events\DeletedCategory;

class CategoryDeleted
{
    public $classifiedRepository;

    public function __construct(ClassifiedRepositoryInterface $classifiedRepository)
    {
        $this->classifiedRepository = $classifiedRepository;
    }

    public function handle(DeletedCategory $event)
    {
        $category = $event->getCategory();

        $catLevelNum = ($category->parent_category_id) ? count($event->getParents()) : 1;

        $catLevelText = "cat" . $catLevelNum;

        $classifieds = $this->classifiedRepository->newQuery()->where($catLevelText, $category->id)->get();
        foreach ($classifieds as $classified) {
            $nullableCats = array();
            for ($i = $catLevelNum; $i <= 10; $i++) {
                $nullableCats['cat' . $i] = null;
            }
            $classified->update($nullableCats);
        }
    }
}