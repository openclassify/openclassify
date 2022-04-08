<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\NavigationModule\Menu\Form\MenuFormBuilder;
use Anomaly\NavigationModule\Menu\Table\MenuTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class MenusController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MenusController extends AdminController
{

    /**
     * Return an index of existing navigation menus.
     *
     * @param  MenuTableBuilder                           $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MenuTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the modal for choosing a menu.
     *
     * @param  MenuRepositoryInterface $menus
     * @return \Illuminate\View\View
     */
    public function choose(MenuRepositoryInterface $menus)
    {
        return view(
            'anomaly.module.navigation::ajax/choose_menu',
            [
                'menus' => $menus->all(),
            ]
        );
    }

    /**
     * Return the form for creating a new navigation menu.
     *
     * @param  MenuFormBuilder                            $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(MenuFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return the form for editing an existing navigation menu.
     *
     * @param  MenuFormBuilder                            $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(MenuFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
