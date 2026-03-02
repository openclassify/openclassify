<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;

class StatusController extends PublicController
{
    private $advRepository;
    private $statusRepository;

    public function __construct(AdvRepositoryInterface $advRepository, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct();
        $this->advRepository = $advRepository;
        $this->statusRepository = $statusRepository;
    }

    public function change($adID, $statusID)
    {
        $ad = $this->advRepository->find($adID);
        $status = $this->statusRepository->find($statusID);

        if (!$ad || !$status) {
            abort(404);
        }

        $ad->changeStatus($status->slug);

        $this->messages->success(trans(
            'visiosoft.module.advs::message.status_change',
            ['status' => $status->name]
        ));

        return redirect()->back();
    }
}
