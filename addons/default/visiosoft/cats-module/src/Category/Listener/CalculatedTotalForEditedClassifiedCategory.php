<?php namespace Visiosoft\CatsModule\Category\Listener;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\ClassifiedsModule\Classified\Event\EditedClassifiedCategory;
use Visiosoft\CatsModule\Category\Command\CalculateClassifiedsCount;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CalculatedTotalForEditedClassifiedCategory
{
    use DispatchesJobs;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        return $this->categoryRepository = $categoryRepository;
    }

    public function handle(EditedClassifiedCategory $event)
    {
        $classified_detail = $event->getClassifiedDetail()->toArray();
        $before_editing_classified = $event->getBeforeEditingParams();

        //Categories New Classified
        $category_fields_new_classified = preg_grep('/^cat/i', array_keys($classified_detail));
        $category_fields_new_classified = array_combine($category_fields_new_classified, $category_fields_new_classified);

        foreach ($category_fields_new_classified as $key => $field) {
            $category_fields_new_classified[$key] = $classified_detail[$key];
        }
        $category_fields_new = array_filter($category_fields_new_classified);

        //Categories Before Editing Classified
        $category_fields_old_classified = preg_grep('/^cat/i', array_keys($before_editing_classified));
        $category_fields_old_classified = array_combine($category_fields_old_classified, $category_fields_old_classified);

        foreach ($category_fields_old_classified as $key => $field) {
            $category_fields_old_classified[$key] = $before_editing_ad[$key];
        }
        $category_fields_old = array_filter($category_fields_old_ad);

        //Update previous category Count
        foreach ($category_fields_old as $category_id) {
            $this->dispatch(new CalculateClassifiedsCount($category_id));
        }

        //Update New Category Count
        foreach ($category_fields_new as $category_id) {
            $this->dispatch(new CalculateClassifiedsCount($category_id));
        }
    }
}