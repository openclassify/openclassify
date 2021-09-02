<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\ClassifiedsModule\Classified\Table\ClassifiedTableBuilder;


class Extend extends ActionHandler
{
    public function handle(ClassifiedTableBuilder $builder, array $selected)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {
            $entry = $model->find($id);
            $finishAt = $entry->finish_at ? $entry->finish_at->addDay(setting_value('visiosoft.module.classifieds::default_published_time')) : date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . setting_value('visiosoft.module.classifieds::default_published_time') . ' day'));
            $entry->finish_at = $finishAt;
            $entry->update();
        }
        if ($selected) {
            $this->messages->success(trans('visiosoft.module.classifieds::field.extended'));
        }
    }
}