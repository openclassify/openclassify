<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
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
        return $this->advRepository->getStockReport();
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
        return $this->advRepository->getUnexplainedClassifiedsReport();
    }

    public function noImage()
    {
        return $this->advRepository->getNoImageClassifiedsReport();
    }

    public function page(PageRepositoryInterface $pageRepository)
    {
        $pages = $pageRepository->newQuery()
            ->select('title as name', 'pages_pages.id')
            ->where(function ($q) {
                $q->whereNull('meta_title')
                    ->orWhereNull('meta_description');
            })
            ->leftJoin('pages_pages_translations as pages_trans', function ($join) {
                $join->on('pages_pages.id', '=', 'pages_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $pages = $pages->where('title', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $pages = $pages->orderBy('title', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $pages->paginate($limit, ['*'], 'page', $page);
    }
}
