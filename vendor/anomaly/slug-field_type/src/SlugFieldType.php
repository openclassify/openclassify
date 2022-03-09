<?php namespace Anomaly\SlugFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class SlugFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SlugFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.slug::input';

    /**
     * The config values.
     *
     * @var array
     */
    protected $config = [
        'type'      => '_',
        'lowercase' => true,
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

    /**
     * Fired just before the entry is saved.
     *
     * @param EntryInterface $entry
     */
    public function onEntryCreating(EntryInterface $entry)
    {
        if (!$entry->{$this->getField()}
            && $this->isRequired()
            && $slugify = array_get($this->getConfig(), 'slugify')
        ) {
            $entry->{$this->getField()} = $entry->{$slugify};
        }
    }
}
