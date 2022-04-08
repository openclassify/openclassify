<?php namespace Anomaly\Streams\Platform\Field\Form\Validator;

/**
 * Class SlugValidator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SlugValidator
{

    /**
     * Handle the validation.
     *
     * @param $value
     */
    public function handle($value)
    {
        return !in_array($value, array_keys(config('streams::locales.supported')));
    }
}
