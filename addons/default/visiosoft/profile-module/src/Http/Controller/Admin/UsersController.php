<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\ProfileModule\Profile\UsersExport;

class UsersController extends AdminController
{
    public function exportUsers()
    {
        return Excel::download(new UsersExport(), 'users-' . time() . '.csv');
    }
}
