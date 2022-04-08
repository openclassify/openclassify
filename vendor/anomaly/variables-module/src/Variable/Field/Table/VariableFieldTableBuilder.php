<?php namespace Anomaly\VariablesModule\Variable\Field\Table;

use Anomaly\Streams\Platform\Field\Table\FieldTableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\VariablesModule\Variable\VariableModel;

/**
 * Class VariableFieldTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariableFieldTableBuilder extends FieldTableBuilder
{

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        [
            'button' => 'blue',
            'text'   => 'module::button.set_value',
            'href'   => 'admin/variables/set/{entry.slug}',
        ],
    ];

    /**
     * Create a new VariableFieldTableBuilder instance.
     *
     * @param Table         $table
     * @param VariableModel $model
     */
    public function __construct(Table $table, VariableModel $model)
    {
        $this->setStream($model->getStream());

        parent::__construct($table);
    }
}
