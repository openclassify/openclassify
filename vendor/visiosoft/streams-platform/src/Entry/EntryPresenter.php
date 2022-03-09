<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentPresenter;
use Anomaly\Streams\Platform\Support\Value;

/**
 * Class EntryPresenter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryPresenter extends EloquentPresenter
{

    /**
     * The resource object.
     * This is for IDE hinting.
     *
     * @var EntryInterface|EloquentModel
     */
    protected $object;

    /**
     * Return the date string for created at.
     *
     * @return string
     */
    public function createdAtDate()
    {
        return $this->object->created_at
            ->format(config('streams::datetime.date_format'));
    }

    /**
     * Return the datetime string for created at.
     *
     * @return string
     */
    public function createdAtDatetime()
    {
        return $this->object->created_at
            ->format(config('streams::datetime.date_format') . ' ' . config('streams::datetime.time_format'));
    }

    /**
     * Return the date string for updated at.
     *
     * @return string
     */
    public function updatedAtDate()
    {
        return $this->object->updated_at
            ->format(config('streams::datetime.date_format'));
    }

    /**
     * Return the datetime string for updated at.
     *
     * @return string
     */
    public function updatedAtDatetime()
    {
        return $this->object->updated_at
            ->format(config('streams::datetime.date_format') . ' ' . config('streams::datetime.time_format'));
    }

    /**
     * Return the date string for last modified.
     *
     * @return string
     */
    public function lastModifiedDate()
    {
        return $this->object->lastModified()
            ->format(config('streams::datetime.date_format'));
    }

    /**
     * Return the datetime string for last modified.
     *
     * @return string
     */
    public function lastModifiedDatetime()
    {
        return $this->object->lastModified()
            ->format(config('streams::datetime.date_format') . ' ' . config('streams::datetime.time_format'));
    }

    /**
     * Return a label.
     *
     * @param         $text
     * @param  string $context
     * @param  string $size
     * @return string
     */
    public function label($text = null, $context = null, $size = null)
    {
        if (!$text) {
            $text = $this->object->getTitleName();
        }

        if (!$context) {
            $context = 'default';
        }

        if (!$size) {
            $size = 'sm';
        }

        /* @var Value $value */
        $value = app(Value::class);

        $text = $value->make($text, $this->object);

        if (trans()->has($text) && is_string(trans($text))) {
            $text = trans($text);
        }

        return '<span class="tag tag-' . $context . ' tag-' . $size . '">' . $text . '</span>';
    }

    /**
     * When accessing a property of a decorated entry
     * object first check to see if the key represents
     * a streams field. If it does then return the field
     * type's presenter object. Otherwise handle normally.
     *
     * @param  $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($assignment = $this->object->getAssignment($key)) {
            $type = $assignment->getFieldType();

            if ($assignment->isTranslatable() && $locale = config('app.locale')) {
                $entry = $this->object->translateOrDefault($locale);

                $type->setLocale($locale);
            } else {
                $entry = $this->object;
            }

            $type->setEntry($entry);

            if (method_exists($type, 'getRelation')) {
                return $type->decorate($entry->getRelationValue(camel_case($key)));
            }

            $type->setValue($entry->getFieldValue($key));

            return $type->getPresenter();
        }

        return $this->__getDecorator()->decorate(parent::__get($key));
    }
}
