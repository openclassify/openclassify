<?php namespace Anomaly\LanguageFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class LanguageFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LanguageFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var LanguageFieldType
     */
    protected $object;

    /**
     * Get the language name.
     *
     * @return null|string
     */
    public function name()
    {
        if (!$key = $this->object->getValue()) {
            return null;
        }

        return trans(array_get($this->object->getOptions(), $key));
    }

    /**
     * Return the translated country name.
     *
     * @param              $locale
     * @return null|string
     */
    public function translated($locale)
    {
        if (!$key = $this->object->getValue()) {
            return null;
        }

        return trans('streams::locale.' . $key . '.name', [], $locale);
    }
}
