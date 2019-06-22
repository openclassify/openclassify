<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;


class Approve extends ActionHandler
{
    public function handle(AdvTableBuilder $builder, array $selected)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {

            $entry = $model->find($id);

            $entry->status = 'approved';

            $entry->update();
        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.approved'));
        }
    }
}