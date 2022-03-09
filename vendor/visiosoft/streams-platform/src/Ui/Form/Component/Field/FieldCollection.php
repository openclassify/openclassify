<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class FieldCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldCollection extends Collection
{

    /**
     * Return base fields only.
     * No translations.
     *
     * @return FieldCollection
     */
    public function base()
    {
        $fields = [];

        $locale = config('streams::locales.default');

        /* @var FieldType $item */
        foreach ($this->items as $item) {

            // If it's the base local then add it.
            if ($item->getLocale() == $locale) {
                $fields[] = $item;
            }

            // If there is no locale then add it.
            if ($item->getLocale() === null) {
                $fields[] = $item;
            }
        }

        return new static($fields);
    }

    /**
     * Return all translations for a field.
     *
     * @param $field
     * @return FieldCollection
     */
    public function translations($field)
    {
        $fields = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if ($item->getFieldName() == $field) {
                $fields[] = $item;
            }
        }

        return new static($fields);
    }

    /**
     * Get a field.
     *
     * @param  mixed $key
     * @param  null $default
     * @return FieldType
     */
    public function get($key, $default = null)
    {
        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if ($item->getField() == $key) {
                return $item;
            }
        }

        if (!$default) {
            return $default;
        }

        return $this->get($default);
    }

    /**
     * Return only translatable fields.
     *
     * @return FieldCollection
     */
    public function translatable()
    {
        $translatable = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if ($item->getLocale()) {
                $translatable[] = $item;
            }
        }

        return new static($translatable);
    }

    /**
     * Return only NON translatable fields.
     *
     * @return FieldCollection
     */
    public function notTranslatable()
    {
        $fields = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if (!$item->getLocale()) {
                $fields[] = $item;
            }
        }

        return new static($fields);
    }

    /**
     * Return enabled fields.
     *
     * @return FieldCollection
     */
    public function enabled()
    {
        $enabled = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if (!$item->isDisabled()) {
                $enabled[] = $item;
            }
        }

        return new static($enabled);
    }

    /**
     * Return disabled fields.
     *
     * @return FieldCollection
     */
    public function disabled()
    {
        $disabled = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if ($item->isDisabled()) {
                $disabled[] = $item;
            }
        }

        return new static($disabled);
    }

    /**
     * Return writable fields.
     *
     * @return FieldCollection
     */
    public function writable()
    {
        return $this->filter(
            function ($item) {

                /* @var FieldType $item */
                return !$item->isReadonly();
            }
        );
    }

    /**
     * Return readonly fields.
     *
     * @return FieldCollection
     */
    public function readonly()
    {
        return $this->filter(
            function ($item) {

                /* @var FieldType $item */
                return $item->isReadonly();
            }
        );
    }

    /**
     * Return auto handling fields.
     *
     * @return FieldCollection
     */
    public function autoHandling()
    {
        return $this->filter(
            function ($field) {

                /* @var FieldType $field */
                return !method_exists($field, 'handle');
            }
        );
    }

    /**
     * Return self handling fields.
     *
     * @return FieldCollection
     */
    public function selfHandling()
    {
        $selfHandling = [];

        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if (method_exists($item, 'handle')) {
                $selfHandling[] = $item;
            }
        }

        return new static($selfHandling);
    }

    /**
     * Return only savable fields.
     *
     * @return FieldCollection
     */
    public function savable()
    {
        return $this->filter(
            function ($field) {

                /* @var FieldType $field */
                return $field->canSave();
            }
        );
    }

    /**
     * Return only non-savable fields.
     *
     * @return FieldCollection
     */
    public function nonSavable()
    {
        return $this->filter(
            function ($field) {

                /* @var FieldType $field */
                return !$field->canSave();
            }
        );
    }

    /**
     * Forget a key.
     *
     * @param mixed $key
     */
    public function forget($key)
    {
        /* @var FieldType $item */
        foreach ($this->items as $index => $item) {
            if ($item->getField() == $key) {
                unset($this->items[$index]);

                break;
            }
        }
    }

    /**
     * Return a unique array of field slugs
     * for all the fields in the collection.
     *
     * @return array
     */
    public function fieldSlugs()
    {
        return array_unique(
            array_map(
                function (FieldType $field) {
                    return $field->getField();
                },
                $this->all()
            )
        );
    }

    /**
     * Return an array of field names
     * for all the fields in the collection.
     *
     * @return array
     */
    public function fieldNames()
    {
        return array_map(
            function (FieldType $field) {
                return $field->getFieldName();
            },
            $this->all()
        );
    }

    /**
     * Return the field partial.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->map(
            function ($fieldType) {

                /* @var FieldType $fieldType */
                return $fieldType->render();
            }
        )->implode("\n");
    }

}
