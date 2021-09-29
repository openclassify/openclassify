<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class ReportController extends AdminController
{
    protected $advRepository;

    public function __construct(AdvRepositoryInterface $advRepository)
    {
        parent::__construct();
        $this->advRepository = $advRepository;
    }

    public function stock()
    {
        return [
            'data' => $this->advRepository->getStockReport()
        ];
    }

    public function status()
    {
        $all = $this->advRepository->getAllClassifiedsCount();
        $active = $this->advRepository->getCurrentClassifiedsCount();

        return [
            'data' => [
                [
                    'status' => 'Active',
                    'count' => $active,
                ],
                [
                    'status' => 'Passive',
                    'count' => $all - $active,
                ],
            ]
        ];
    }

    public function unexplained()
    {
        return [
            'data' => $this->advRepository->getUnexplainedClassifiedsReport()
        ];
    }

    public function noImage()
    {
        return [
            'data' => $this->advRepository->getNoImageClassifiedsReport()
        ];
    }
}
