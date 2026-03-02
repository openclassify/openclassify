<?php namespace Visiosoft\CatsModule\Category\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\CatsModule\Category\Traits\DeleteCategory;

class Delete extends ActionHandler
{
    use DeleteCategory;

    public function handle(array $selected)
    {
        $this->deleteCategories($selected);
    }
}