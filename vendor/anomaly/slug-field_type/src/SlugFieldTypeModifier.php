<?php namespace Anomaly\SlugFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Illuminate\Support\Str;

/**
 * Class SlugFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SlugFieldTypeModifier extends FieldTypeModifier
{

    /**
     * The string utility.
     *
     * @var Str
     */
    protected $str;

    /**
     * Create a new SlugFieldTypeModifier instance.
     *
     * @param Str $str
     */
    public function __construct(Str $str)
    {
        $this->str = $str;
    }

    /**
     * Modify the value.
     *
     * @param $value
     * @return string
     */
    public function modify($value)
    {
        $type = array_get($this->fieldType->getConfig(), 'type', '_');

        return trim($this->str->slug($value, $type), $type);
    }
}
