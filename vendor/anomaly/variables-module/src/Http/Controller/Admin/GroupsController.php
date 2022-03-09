<?php namespace Anomaly\VariablesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\VariablesModule\Group\Form\GroupFormBuilder;
use Anomaly\VariablesModule\Group\Table\GroupTableBuilder;

/**
 * Class GroupsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GroupsController extends AdminController
{

    /**
     * Return an index of existing entries.
     *
     * @param  GroupTableBuilder                          $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(GroupTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form for a new page type.
     *
     * @param  GroupFormBuilder                           $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(GroupFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a form for editing an existing page type.
     *
     * @param  GroupFormBuilder                           $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(GroupFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
