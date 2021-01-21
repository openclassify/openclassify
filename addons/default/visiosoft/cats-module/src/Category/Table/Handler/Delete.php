<?php namespace Visiosoft\CatsModule\Category\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\Table\CategoryTableBuilder;

class Delete extends ActionHandler
{
    public function handle(
        CategoryTableBuilder $builder, array $selected,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        try {
            foreach ($selected as $id) {
               //Todo Delete category and Sub Categories
            }

            if ($selected) {
                $this->messages->success(trans('visiosoft.module.cats::message.categories_mass_delete_success'));
            }
        } catch (\Exception $e) {
            $this->messages->error($e->getMessage());
        }
    }
}