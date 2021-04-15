<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;


class Approve extends ActionHandler
{
    public function handle(AdvTableBuilder $builder, array $selected, SettingRepositoryInterface $settingRepository)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {
            $defaultAdPublishTime = $settingRepository->value('visiosoft.module.advs::default_published_time');

            if ($ad = $model->newQuery()->find($id)) {

                $ad->update([
                    'status' => 'approved',
                    'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
                    'publish_at' => date('Y-m-d H:i:s')
                ]);

                event(new ChangedStatusAd($ad));//Create Notify
            }
        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.approved'));
        }
    }
}