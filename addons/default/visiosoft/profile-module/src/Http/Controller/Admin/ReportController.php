<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Carbon\Carbon;

class ReportController extends AdminController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function latest()
    {
        $members = $this->userRepository->newQuery()
            ->selectRaw("DATE_FORMAT(created_at, '%d.%m.%Y %H:%i') as date, CONCAT_WS('', first_name, ' ', last_name) AS member, id AS user_id")
            ->where('created_at', '>=', Carbon::today()->subWeek());

        if ($search = request('search.value')) {
            $members = $members->whereRaw("
                (SELECT CONCAT_WS('', first_name, ' ', last_name) AS member) LIKE '%$search%'
            ");
        }

        if ($orderDir = request('order.0.dir')) {
            $members = $members->orderBy('member', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $members->paginate($limit, ['*'], 'page', $page);
    }

    public function login()
    {
        $members = $this->userRepository->newQuery()
            ->selectRaw("DATE_FORMAT(last_login_at, '%d.%m.%Y %H:%i') as date, CONCAT_WS('', first_name, ' ', last_name) AS member")
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '>=', Carbon::today()->subWeek());

        if ($search = request('search.value')) {
            $members = $members->whereRaw("
                (SELECT CONCAT_WS('', first_name, ' ', last_name) AS member) LIKE '%$search%'
            ");
        }

        if ($orderDir = request('order.0.dir')) {
            $members = $members->orderBy('member', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $members->paginate($limit, ['*'], 'page', $page);
    }
}
