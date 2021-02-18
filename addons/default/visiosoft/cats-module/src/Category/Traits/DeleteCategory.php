<?php namespace Visiosoft\CatsModule\Category\Traits;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Visiosoft\CatsModule\Category\CategoryModel;

trait DeleteCategory
{
    public function deleteCategories(array $selected)
    {
        $messages = app(MessageBag::class);
        $count = 0;

        foreach ($selected as $id) {
            if ($this->deleteCategory($id)) {
                $count++;
            }
        }

        if ($selected && $count > 0) {
            $messages->success(trans('streams::message.delete_success', compact('count')));
        }
    }

    public function deleteCategory($id)
    {
        $model = new CategoryModel();

        $entry = $model->find($id);

        $deletable = true;

        if ($entry instanceof EloquentModel) {
            $deletable = $entry->isDeletable();
        }

        if ($entry && $deletable && $entry->delete()) {
            return true;
        }
        return false;
    }
}