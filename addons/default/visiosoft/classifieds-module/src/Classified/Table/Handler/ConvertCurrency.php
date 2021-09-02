<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Handler;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\ClassifiedsModule\Classified\Table\ClassifiedTableBuilder;


class ConvertCurrency extends ActionHandler
{
    public function handle(ClassifiedTableBuilder $builder, array $selected, SettingRepositoryInterface $settingRepository)
    {
        $model = $builder->getTableModel();

        foreach ($selected as $id) {
            $entry = $model->newQuery()->find($id);
            if ($entry) {
                $model->foreignCurrency($entry->currency, $entry->price, $id, $settingRepository);
            }
        }
        if ($selected) {
            $this->messages->success(trans('visiosoft.module.classifieds::message.currency_converted'));
        }
    }
}