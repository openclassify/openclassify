<?php namespace Anomaly\VariablesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Model\Variables\VariablesTestGroupEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\VariablesModule\Variable\Field\Table\VariableFieldTableBuilder;
use Anomaly\VariablesModule\Variable\Form\VariableFormBuilder;
use Anomaly\VariablesModule\Variable\Table\VariableTableBuilder;

/**
 * Class VariablesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariablesController extends AdminController
{

    /**
     * Return an index of existing variable fields.
     *
     * @param  VariableFieldTableBuilder                  $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VariableTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a form to edit the variables.
     *
     * @param  StreamRepositoryInterface                  $streams
     * @param  VariableFormBuilder                        $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(StreamRepositoryInterface $streams, VariableFormBuilder $form, $id)
    {
        /* @var StreamInterface $group */
        $group = $streams->find($id);

        $entry = $group->getEntryModel()->firstOrNew([]);

        return $form->setModel($group->getEntryModelName())->render($entry);
    }
}
