<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Field\Table\FieldTableBuilder;

/**
 * Class FieldsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldsController extends AdminController
{

    /**
     * The stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * Return an index of existing fields.
     *
     * @param FieldTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FieldTableBuilder $table)
    {
        return $table
            ->setNamespace($this->getNamespace())
            ->render();
    }

    /**
     * Choose a field type for creating a field.
     *
     * @param  FieldTypeCollection $fieldTypes
     * @param ModuleCollection     $modules
     * @return \Illuminate\View\View
     */
    public function choose(FieldTypeCollection $fieldTypes, ModuleCollection $modules)
    {
        return $this->view->make(
            'streams::fields/choose',
            [
                'field_types' => $fieldTypes,
                'module'      => $modules->active(),
            ]
        );
    }

    /**
     * Create a new field.
     *
     * @param  FieldFormBuilder    $form
     * @param  FieldTypeCollection $fieldTypes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FieldFormBuilder $form, FieldTypeCollection $fieldTypes)
    {
        return $form
            ->setNamespace($this->getNamespace())
            ->setFieldType($fieldTypes->get($this->request->get('field_type')))
            ->render();
    }

    /**
     * Edit an existing field.
     *
     * @param  FieldFormBuilder   $form
     * @param FieldTypeCollection $fieldTypes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FieldFormBuilder $form, FieldTypeCollection $fieldTypes)
    {
        return $form
            ->setNamespace($this->getNamespace())
            ->setFieldType($fieldTypes->get($this->request->get('field_type')))
            ->render($this->route->parameter('id'));
    }

    /**
     * Choose a field type for changing an existing field.
     *
     * @param  FieldTypeCollection $fieldTypes
     * @return \Illuminate\View\View
     */
    public function change(FieldTypeCollection $fieldTypes, ModuleCollection $modules)
    {
        return $this->view->make(
            'streams::fields/change',
            [
                'field_types' => $fieldTypes->filter(
                    function (FieldType $fieldType) {
                        return $fieldType->getColumnType() !== false;
                    }
                ),
                'module'      => $modules->active(),
            ]
        );
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}
