<?php namespace Visiosoft\ClassifiedsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Status\Contract\StatusRepositoryInterface;

class StatusController extends PublicController
{
    private $classifiedRepository;
    private $statusRepository;

    public function __construct(ClassifiedRepositoryInterface $classifiedRepository, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct();
        $this->classifiedRepository = $classifiedRepository;
        $this->statusRepository = $statusRepository;
    }

    public function change($adID, $statusID)
    {
        $classified = $this->classifiedRepository->find($adID);
        $status = $this->statusRepository->find($statusID);

        if (!$classified || !$status) {
            abort(404);
        }

        $classified->changeStatus($status->slug);

        $this->messages->success(trans(
            'visiosoft.module.classifieds::message.status_change',
            ['status' => $status->name]
        ));

        return redirect()->back();
    }
}
