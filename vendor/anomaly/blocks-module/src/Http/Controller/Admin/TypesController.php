<?php namespace Anomaly\BlocksModule\Http\Controller\Admin;

use Anomaly\BlocksModule\Type\Form\TypeFormBuilder;
use Anomaly\BlocksModule\Type\Table\TypeTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class TypesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypesController extends AdminController
{

    /**
     * Return an index of existing block types.
     *
     * @param  TypeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form for a new block type.
     *
     * @param  TypeFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TypeFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a form for editing an existing block type.
     *
     * @param  TypeFormBuilder $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TypeFormBuilder $form, $id)
    {
        return $form->render($id);
    }

}
