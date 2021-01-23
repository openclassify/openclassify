<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Visiosoft\LocationModule\Country\Form\CountryFormBuilder;
use Visiosoft\LocationModule\Country\Table\CountryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CountriesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CountryTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CountryTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CountryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CountryFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CountryFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CountryFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
