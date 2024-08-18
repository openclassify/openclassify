<?php namespace Visiosoft\CommentsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CommentsModule\Comment\Contract\CommentRepositoryInterface;

class ReportController extends AdminController
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        parent::__construct();
        $this->commentRepository = $commentRepository;
    }

    public function product()
    {
        return $this->commentRepository->getProductsRateReport();
    }

    public function comment()
    {
        return $this->commentRepository->getProductsCommentsReport();
    }
}
