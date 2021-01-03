<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Visiosoft\AdvsModule\ProductoptionsValue\Form\ProductoptionsValueFormBuilder;
use Visiosoft\AdvsModule\ProductoptionsValue\Table\ProductoptionsValueTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ProductoptionsValueController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ProductoptionsValueTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProductoptionsValueTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ProductoptionsValueFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ProductoptionsValueFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ProductoptionsValueFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ProductoptionsValueFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
