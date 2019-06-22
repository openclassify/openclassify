<?php namespace Visiosoft\CatsModule\Http\Controller\Admin;

use Visiosoft\CatsModule\Placeholderforsearch\Form\PlaceholderforsearchFormBuilder;
use Visiosoft\CatsModule\Placeholderforsearch\Table\PlaceholderforsearchTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class PlaceholderforsearchController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param PlaceholderforsearchTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PlaceholderforsearchTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param PlaceholderforsearchFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PlaceholderforsearchFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param PlaceholderforsearchFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PlaceholderforsearchFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
