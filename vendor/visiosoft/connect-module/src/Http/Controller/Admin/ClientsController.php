<?php namespace Visiosoft\ConnectModule\Http\Controller\Admin;

use Visiosoft\ConnectModule\Client\Form\ClientFormBuilder;
use Visiosoft\ConnectModule\Client\Table\ClientTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ClientsController
 *

 */
class ClientsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ClientTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ClientTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ClientFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ClientFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ClientFormBuilder $form
     * @param                   $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ClientFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
