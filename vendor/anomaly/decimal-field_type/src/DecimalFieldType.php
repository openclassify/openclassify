<?php namespace Anomaly\DecimalFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Http\Request;

/**
 * Class DecimalFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DecimalFieldType
 */
class DecimalFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'float';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.decimal::input';

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'numeric',
    ];

    /**
     * The default config.
     *
     * @var array
     */
    protected $config = [
        'separator' => ',',
        'point'     => '.',
        'digits'    => 11,
        'decimals'  => 2,
        'min'       => 0,
    ];

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new IntegerFieldType instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if (!is_null($min = array_get($this->config, 'min'))) {
            $rules[] = 'min:' . $min;
        }

        if (!is_null($max = array_get($this->config, 'max'))) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }
}
