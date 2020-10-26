<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\ProfileModule\Profile\UsersExport;

class UsersController extends AdminController
{
    public function exportUsers()
    {
        return Excel::download(new UsersExport(), 'users-' . time() . '.csv');
    }

    public function queryUsers(UserRepositoryInterface $userRepository)
    {
        $term = request()->term;
        if ($term) {
            return $userRepository->newQuery()
                ->select(DB::raw("CONCAT_WS('', first_name, ' ', last_name, ' (', gsm_phone, ' || ', email, ')') AS name"), 'id')
                ->where('first_name', 'LIKE', "%$term%")
                ->orWhere('last_name', 'LIKE', "%$term%")
                ->orWhere('gsm_phone', 'LIKE', "%$term%")
                ->limit(5)
                ->pluck('name', 'id');
        }
    }
}
