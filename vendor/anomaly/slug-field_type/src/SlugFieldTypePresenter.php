<?php namespace Anomaly\SlugFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class SlugFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SlugFieldTypePresenter extends FieldTypePresenter
{

    /**
     * Return the humanized string.
     *
     * @return string
     */
    public function humanize()
    {
        return str_replace(array_get($this->object->getConfig(), 'type'), ' ', $this->object->getValue());
    }

    /**
     * Return the humanized string.
     *
     * @deprecated Remove in 2.0
     * @return string
     */
    public function humanized()
    {
        return $this->humanize();
    }
}
