<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;

class Extend extends ActionHandler
{
    public function handle(AdvTableBuilder $builder, array $selected)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {
            $entry = $model->find($id);
            $finishAt = $entry->finish_at ? $entry->finish_at->addDay(setting_value('visiosoft.module.advs::default_published_time')) : date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . setting_value('visiosoft.module.advs::default_published_time') . ' day'));
            $entry->finish_at = $finishAt;
            $entry->update();
        }
        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.extended'));
        }
    }
}
