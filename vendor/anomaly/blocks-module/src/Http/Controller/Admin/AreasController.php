<?php namespace Anomaly\BlocksModule\Http\Controller\Admin;

use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\BlocksModule\Area\Form\AreaFormBuilder;
use Anomaly\BlocksModule\Area\Table\AreaTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AreasController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AreasController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param AreaTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AreaTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param AreaFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(AreaFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a list of areas to view.
     *
     * @param AreaRepositoryInterface $areas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choose(AreaRepositoryInterface $areas)
    {
        return $this->view->make(
            'anomaly.module.blocks::admin/areas/choose',
            [
                'areas' => $areas->all(),
            ]
        );
    }

    /**
     * Edit an existing entry.
     *
     * @param AreaFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AreaFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
