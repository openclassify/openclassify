<?php

namespace Anomaly\Streams\Platform\Ui\Form;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class FormMessages
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormMessages
{

    /**
     * Make custom validation messages.
     *
     * @param  FormBuilder $builder
     * @return array
     */
    public function make(FormBuilder $builder)
    {
        $messages = [];

        foreach ($builder->getEnabledFormFields() as $field) {
            foreach ($field->getValidators() as $rule => $validator) {
                if ($message = Arr::get($validator, 'message')) {
                    $message = trans($message);
                }

                if ($message && Str::contains($message, '::')) {
                    $message = trans($message);
                }

                $messages[$field->prefix . $field->field . '.' . $rule] = $message;
            }

            foreach ($field->getMessages() as $rule => $message) {
                if ($message && Str::contains($message, '::')) {
                    $message = trans($message);
                }

                $messages[$field->prefix . $field->field . '.' . $rule] = $message;
            }
        }

        return $messages;
    }
}
