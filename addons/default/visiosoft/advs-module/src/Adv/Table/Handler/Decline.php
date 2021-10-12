<?php namespace Visiosoft\AdvsModule\Adv\Table\Handler;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Visiosoft\AdvsModule\Adv\Command\UpdateClassifiedStatus;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class Decline extends ActionHandler
{
    public function handle(AdvRepositoryInterface $advRepository, array $selected)
    {
        foreach ($selected as $id) {
            $classified = $advRepository->find($id);

            $this->dispatch(new UpdateClassifiedStatus($classified, 'declined'));
        }

        if ($selected) {
            $this->messages->success(trans('visiosoft.module.advs::field.declined'));
        }
    }
}
