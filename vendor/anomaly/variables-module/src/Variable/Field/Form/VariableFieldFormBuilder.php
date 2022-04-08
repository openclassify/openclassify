<?php namespace Anomaly\VariablesModule\Variable\Field\Form;

use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\VariablesModule\Variable\VariableModel;

/**
 * Class VariableFieldFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariableFieldFormBuilder extends FieldFormBuilder
{

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'auto_assign' => true,
    ];

    /**
     * Create a new VariableFieldFormBuilder instance.
     *
     * @param Form          $form
     * @param VariableModel $model
     */
    public function __construct(Form $form, VariableModel $model)
    {
        $this->setStream($model->getStream());

        parent::__construct($form);
    }
}
