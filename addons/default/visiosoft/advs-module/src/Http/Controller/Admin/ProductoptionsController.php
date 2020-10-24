<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Visiosoft\AdvsModule\Productoption\Form\ProductoptionFormBuilder;
use Visiosoft\AdvsModule\Productoption\Table\ProductoptionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ProductoptionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ProductoptionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProductoptionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ProductoptionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ProductoptionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ProductoptionFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ProductoptionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
