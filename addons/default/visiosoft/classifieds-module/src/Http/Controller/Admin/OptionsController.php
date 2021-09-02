<?php namespace Visiosoft\ClassifiedsModule\Http\Controller\Admin;

use Visiosoft\ClassifiedsModule\Option\Form\OptionFormBuilder;
use Visiosoft\ClassifiedsModule\Option\Table\OptionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class OptionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param OptionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(OptionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param OptionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(OptionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param OptionFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(OptionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
