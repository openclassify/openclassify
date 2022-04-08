<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Session\Store;

/**
 * Class FieldPopulator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldPopulator
{

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * Create a new FieldPopulator instance.
     *
     * @param $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Populate the fields with entry values.
     *
     * @param FormBuilder $builder
     */
    public function populate(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $entry  = $builder->getFormEntry();

        /**
         * This is a brute force fix for the
         * url.intended that is set by Laravel
         * for redirecting kicked login attempts.
         *
         * URL intended becomes an empty url array.
         *
         * Since we're here - we don't need it anyways.
         */
        if (!$this->session->get('url')) {
            $this->session->pull('url');
        }

        foreach ($fields as &$field) {

            /*
             * If the field is not already set
             * then get the value off the entry.
             *
             * @var todo
             * This needs to be tweaked slightly for duplication in the near future.
             * The " && $entry->getId()" get's removed but needs replaced with something duplication specific.
             */
            if (!isset($field['value']) && $entry instanceof EloquentModel && $entry->getId()) {

                $locale = array_get($field, 'locale');

                if ($locale && $translation = $entry->translate($locale)) {
                    $field['value'] = $translation->getAttribute($field['field']);
                } else {
                    $field['value'] = $entry->{$field['field']};
                }
            }

            /*
             * If the field has a default value
             * and the entry does not exist yet
             * then use the default value.
             */
            if (isset($field['config']['default_value']) && $entry instanceof EloquentModel && !$entry->getId()) {
                $field['value'] = $field['config']['default_value'];
            }

            /*
             * If the field has a default value
             * and there is no entry then
             * use the default value.
             */
            if (isset($field['config']['default_value']) && !$entry) {
                $field['value'] = $field['config']['default_value'];
            }

            /*
             * If the field is an assignment then
             * use it's config for the default value.
             */
            if (!isset($field['value']) && $entry instanceof EntryInterface && $type = $entry->getFieldType(
                    $field['field']
                )
            ) {
                $field['value'] = array_get($type->getConfig(), 'default_value');
            }

            /*
             * Lastly if we have flashed data from a front end
             * form handler then use that value for the field.
             */
            if ($this->session->has($field['prefix'] . $field['field'])) {
                $field['value'] = $this->session->pull($field['prefix'] . $field['field']);
            }
        }

        $builder->setFields($fields);
    }
}
