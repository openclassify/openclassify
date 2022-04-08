<?php namespace Anomaly\TextareaFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class TextareaFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TextareaFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'text';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.textarea::input';

    /**
     * The field config.
     *
     * @var array
     */
    protected $config = [
        'rows'     => 6,
        'storage'  => null,
        'autogrow' => true,
    ];

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if ($min = array_get($this->getConfig(), 'min')) {
            $rules[] = 'min:' . $min;
        }

        if ($max = array_get($this->getConfig(), 'max')) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }
}
