<?php namespace Anomaly\DashboardModule\Http\Controller\Admin;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardInterface;
use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\DashboardModule\Dashboard\Form\DashboardFormBuilder;
use Anomaly\DashboardModule\Dashboard\Table\DashboardTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class DashboardsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardsController extends AdminController
{

    /**
     * Display a management index of existing entries.
     *
     * @param  DashboardRepositoryInterface          $dashboards
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(DashboardRepositoryInterface $dashboards)
    {
        $dashboards = $dashboards->allowed();

        /* @var DashboardInterface $dashboard */
        if (!$dashboard = $dashboards->first()) {
            return $this->redirect->to('admin/dashboard/manage');
        }

        return $this->redirect->to('admin/dashboard/view/' . $dashboard->getSlug());
    }

    /**
     * Display a management index of existing entries.
     *
     * @param  DashboardTableBuilder                      $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manage(DashboardTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param  DashboardFormBuilder                       $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DashboardFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param  DashboardFormBuilder                       $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DashboardFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * View a dashboard.
     *
     * @param  DashboardRepositoryInterface          $dashboards
     * @param  Guard                                 $guard
     * @param                                        $dashboard
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(DashboardRepositoryInterface $dashboards, Guard $guard, $dashboard)
    {
        $dashboards = $dashboards->allowed();

        /* @var DashboardInterface $dashboard */
        if (!$dashboard = $dashboards->find($dashboard)) {
            abort(404);
        }

        $dashboard->setActive(true);

        /* @var UserInterface $user */
        $user  = $guard->user();
        $roles = $dashboard->getAllowedRoles();

        if (!$roles->isEmpty() && !$user->hasAnyRole($roles)) {
            abort(403);
        }

        $this->template->set('show_banner', true);

        return $this->view->make(
            'module::admin/dashboards/dashboard',
            [
                'dashboard'  => $dashboard,
                'dashboards' => $dashboards,
            ]
        );
    }
}
