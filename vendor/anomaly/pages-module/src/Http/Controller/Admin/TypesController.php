<?php namespace Anomaly\PagesModule\Http\Controller\Admin;

use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PagesModule\Type\Form\TypeFormBuilder;
use Anomaly\PagesModule\Type\Table\TypeTableBuilder;
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
     * Return an index of existing page types.
     *
     * @param  TypeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the modal to choose a page type.
     *
     * @param TypeRepositoryInterface $types
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(TypeRepositoryInterface $types)
    {
        return $this->view->make(
            'module::admin/pages/choose',
            [
                'types' => $types->all(),
            ]
        );
    }

    /**
     * Return the modal to change a page type.
     *
     * @param TypeRepositoryInterface $types
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function change(TypeRepositoryInterface $types, $id)
    {
        return $this->view->make(
            'module::admin/pages/change',
            [
                'types' => $types->all(),
                'page'  => $id,
            ]
        );
    }

    /**
     * Return a form for a new page type.
     *
     * @param  TypeFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TypeFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return a form for editing an existing page type.
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
