<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Handler;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\ClassifiedsModule\Classified\Event\ChangedStatusAd;
use Visiosoft\ClassifiedsModule\Classified\Table\ClassifiedTableBuilder;


class Approve extends ActionHandler
{
    public function handle(ClassifiedTableBuilder $builder, array $selected, SettingRepositoryInterface $settingRepository)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {
            $defaultAdPublishTime = $settingRepository->value('visiosoft.module.classifieds::default_published_time');

            if ($classified = $model->newQuery()->find($id)) {

                $update = [
                    'status' => 'approved',
                ];

                if (!setting_value('visiosoft.module.classifieds::show_finish_and_publish_date')) {
                    $update = array_merge($update, [
                        'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
                        'publish_at' => date('Y-m-d H:i:s')
                    ]);
                }

                $classified->update($update);

                event(new ChangedStatusAd($classified));//Create Notify
            }
        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.classifieds::field.approved'));
        }
    }
}