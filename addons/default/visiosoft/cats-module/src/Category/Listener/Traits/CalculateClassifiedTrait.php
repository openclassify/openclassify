<?php namespace Visiosoft\CatsModule\Category\Listener\Traits;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\CatsModule\Category\Command\CalculateClassifiedsCount;

trait CalculateClassifiedTrait
{
    use DispatchesJobs;

    public function calculateClassifiedAction($ad_detail)
    {
        $category_fields = preg_grep('/^cat/i', array_keys($ad_detail));
        $category_fields = array_combine($category_fields, $category_fields);

        foreach ($category_fields as $key => $field) {
            $category_fields[$key] = $ad_detail[$key];
        }

        $category_fields = array_filter($category_fields);

        foreach ($category_fields as $category_id) {
            $this->dispatch(new CalculateClassifiedsCount($category_id));
        }
    }
}