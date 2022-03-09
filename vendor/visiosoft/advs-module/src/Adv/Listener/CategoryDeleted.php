<?php namespace Visiosoft\AdvsModule\Adv\Listener;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Events\DeletedCategory;

class CategoryDeleted
{
    public $advRepository;

    public function __construct(AdvRepositoryInterface $advRepository)
    {
        $this->advRepository = $advRepository;
    }

    public function handle(DeletedCategory $event)
    {
        $category = $event->getCategory();

        $catLevelNum = ($category->parent_category_id) ? count($event->getParents()) : 1;

        $catLevelText = "cat" . $catLevelNum;

        $advs = $this->advRepository->newQuery()->where($catLevelText, $category->id)->get();
        foreach ($advs as $adv) {
            $nullableCats = array();
            for ($i = $catLevelNum; $i <= 10; $i++) {
                $nullableCats['cat' . $i] = null;
            }
            $adv->update($nullableCats);
        }
    }
}