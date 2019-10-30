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
            $finishAt = $entry->finish_at ? $entry->finish_at->addDay(30) : date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 30 day'));
            $entry->finish_at = $finishAt;
            $entry->update();
        }
        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.extended'));
        }
    }
}