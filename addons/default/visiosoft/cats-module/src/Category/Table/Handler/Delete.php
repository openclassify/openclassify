<?php namespace Visiosoft\CatsModule\Category\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class Delete extends ActionHandler
{
    public function handle(array $selected, CategoryRepositoryInterface $categoryRepository)
    {
        try {
            foreach ($selected as $id) {
                $categoryRepository->DeleteCategories($id);
            }

            if ($selected) {
                $this->messages->success(trans('visiosoft.module.cats::message.categories_mass_delete_success'));
            }
        } catch (\Exception $e) {
            $this->messages->error($e->getMessage());
        }
    }
}