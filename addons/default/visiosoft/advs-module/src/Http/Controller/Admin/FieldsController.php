<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Form\FieldAssignmentFormBuilder;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\Assignment\AssignmentObserver;
use Illuminate\Http\Request;
use Visiosoft\AdvsModule\Adv\AdvModel;

/**
 * Class FieldsController
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class FieldsController extends AdminController
{

    /**
     * Return an index of existing fields.
     *
     * @param  AssignmentTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AssignmentTableBuilder $table, AdvModel $advs)
    {
        AssignmentModel::observe(AssignmentObserver::class);

        return $table
            ->setOption('sortable', true)
            ->setStream($advs->getStream())
            ->render();
    }

    /**
     * Choose a field type for creating a field.
     *
     * @param  FieldTypeCollection $fieldTypes
     * @return \Illuminate\View\View
     */
    public function choose(FieldTypeCollection $fieldTypes)
    {
        return $this->view->make('visiosoft.module.advs::admin/fields/choose', ['field_types' => $fieldTypes]);
    }

    public function create(FieldFormBuilder $form, AdvModel $advs, FieldTypeCollection $fieldTypes)
    {
        $form
            ->setStream($advs->getStream())
            ->setOption('auto_assign', true)
            ->setFieldType($fieldTypes->get($this->request->get('field_type')));

        if ($this->request->action == 'save') {
            $form->render();
            $fields = new AdvModel();

            $last_field = $fields->getLatestField($this->request->slug);
            $fields->saveCustomField($this->request->id, $last_field->id, $last_field->slug);

            return redirect('/admin/advs/categories');
        } else {
            return $form->render();
        }

    }

    public function edit(AssignmentRepositoryInterface $assignments, FieldFormBuilder $form, AdvModel $model, $id)
    {
        /* @var AssignmentInterface $assignment */
        $custom_field = new AdvModel();
        $custom_field_id = $custom_field->getCustomFieldEditId($id);

        $assignment = $assignments->find($custom_field_id->id);

        return $form
            ->setStream($model->getStream())
            ->render($assignment->getFieldId());
    }
}
