<?php namespace Visiosoft\ListFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ListFieldType
 *
 * @author        Dia shalabi. <dia@visiosoft.com.tr>
 * @package       Visiosoft\ListFieldType
 */
class ListFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'text';

    /**
     * The field input view.
     *
     * @var string
     */
    protected $inputView = 'visiosoft.field_type.list::input';


    /**
     * The config array.
     *
     * @var array
     */
    protected $config = [
        'type' => 'text'
    ];

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if ($min = $this->config('min')) {
            $rules[] = 'min:' . $min;
        }

        if ($max = $this->config('max')) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }
}
