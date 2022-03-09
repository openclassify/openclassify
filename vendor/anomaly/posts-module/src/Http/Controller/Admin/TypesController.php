<?php namespace Anomaly\PostsModule\Http\Controller\Admin;

use Anomaly\PostsModule\Type\Form\TypeFormBuilder;
use Anomaly\PostsModule\Type\Table\TypeTableBuilder;
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
     * Return an index of types.
     *
     * @param  TypeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the form for creating a new type.
     *
     * @param  TypeFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TypeFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return the form for editing an existing type.
     *
     * @param  TypeFormBuilder                            $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TypeFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
