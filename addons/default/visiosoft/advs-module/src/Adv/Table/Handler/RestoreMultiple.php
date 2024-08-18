<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class RestoreMultiple extends ActionHandler
{
    public function handle(AdvRepositoryInterface $advRepository, array $selected, TableBuilder $builder)
    {
        try {
            $count = count($selected);
            if ($count>0) {
                $advRepository->restoreMultiple($selected);
                $this->messages->success(trans('streams::message.delete_success', compact('count')));
            }
        }catch (\Exception $e){
            $log = new Logger('advs_restore_multiple');
            $log->pushHandler(new StreamHandler(storage_path('logs/advs_restore_multiple.log')), Logger::ERROR);
            $log->error($e);
            $this->messages->error(trans('visiosoft.module.advs::message.error_general'));
        }
        return redirect()->back();

    }
}
