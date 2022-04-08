<?php

namespace Anomaly\TagsFieldType\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\TagsFieldType\TagsFieldType;

/**
 * Class FilterValidator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FilterValidator
{

    /**
     * Handle the validation.
     *
     * @param  FormBuilder $builder
     * @param              $attribute
     * @param              $value
     * @return bool
     */
    public function handle(TagsFieldType $fieldType, $attribute, $value)
    {
        $filters = (array) array_get($fieldType->getConfig(), 'filter', []);

        if (!$filters || !$value) {
            return true;
        }

        foreach ($value as $tag) {

            $passes = true;

            foreach ($filters as $filter) {
                if (!$this->passes($tag, $filter)) {
                    $passes = false;
                }
            }

            if (!$passes) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return if a tag passes the filter.
     *
     * @param $tag
     * @param $filter
     * @return bool
     */
    protected function passes($tag, $filter)
    {
        switch ($filter) {

            case 'FILTER_VALIDATE_EMAIL':
                return filter_var($tag, FILTER_VALIDATE_EMAIL) !== false;

            case 'FILTER_VALIDATE_URL':
                return filter_var($tag, FILTER_VALIDATE_URL) !== false;

            case 'FILTER_VALIDATE_IP':
                return filter_var($tag, FILTER_VALIDATE_IP) !== false;

            default:
                return str_is($filter, $tag);
        }
    }
}
