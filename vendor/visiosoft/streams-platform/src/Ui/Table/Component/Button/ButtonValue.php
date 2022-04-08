<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Button;

use Anomaly\Streams\Platform\Support\Value;

/**
 * Class ButtonValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonValue
{

    /**
     * The value utility.
     *
     * @var Value
     */
    protected $value;

    /**
     * Create a new ButtonValue instance.
     *
     * @param Value $value
     */
    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    /**
     * Replace the entry values
     * in the button property.
     *
     * @param  array $button
     * @param        $entry
     * @return array
     */
    public function replace(array $button, $entry)
    {
        $enabled = array_get($button, 'enabled');

        if (is_string($enabled)) {
            $enabled = filter_var($this->value->make($enabled, $entry), FILTER_VALIDATE_BOOLEAN);

            $button['enabled'] = $enabled;
        }

        return $button;
    }
}
