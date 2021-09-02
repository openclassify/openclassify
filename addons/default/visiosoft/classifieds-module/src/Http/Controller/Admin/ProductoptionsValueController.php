<?php namespace Visiosoft\ClassifiedsModule\Http\Controller\Admin;

use Visiosoft\ClassifiedsModule\ProductoptionsValue\Form\ProductoptionsValueFormBuilder;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\Table\ProductoptionsValueTableBuilder;
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
