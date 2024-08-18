<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class ReportController extends AdminController
{
    public function category(CategoryRepositoryInterface $categoryRepository)
    {
        return $categoryRepository->noMetaReport();
    }
}
