<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;


class Decline extends ActionHandler
{
    public function handle(AdvTableBuilder $builder, array $selected)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {

            $ad = $model->find($id);
            $ad->status = 'declined';
            $ad->update();

            event(new ChangedStatusAd($ad));//Create Notify

        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.declined'));
        }
    }
}