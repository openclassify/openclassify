<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\ClassifiedsModule\Classified\Event\ChangedStatusAd;
use Visiosoft\ClassifiedsModule\Classified\Table\ClassifiedTableBuilder;


class Decline extends ActionHandler
{
    public function handle(ClassifiedTableBuilder $builder, array $selected)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {

            $classified = $model->find($id);
            $classified->status = 'declined';
            $classified->update();

            event(new ChangedStatusAd($classified));//Create Notify

        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.classifieds::field.declined'));
        }
    }
}