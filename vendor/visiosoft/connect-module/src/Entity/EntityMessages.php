<?php namespace Anomaly\Streams\Platform\Ui\Entity;

/**
 * Class EntityMessages
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityMessages
{

    /**
     * Make custom validation messages.
     *
     * @param EntityBuilder $builder
     * @return array
     */
    public function make(EntityBuilder $builder)
    {
        $messages = [];

        foreach ($builder->getEnabledEntityFields() as $field) {

            foreach ($field->getValidators() as $rule => $validator) {

                $message = trans(array_get($validator, 'message'));

                if ($message && str_contains($message, '::')) {
                    $message = trans($message);
                }

                $messages[$rule] = $message;
            }

            foreach ($field->getMessages() as $rule => $message) {

                if ($message && str_contains($message, '::')) {
                    $message = trans($message);
                }

                $messages[$rule] = $message;
            }
        }

        return $messages;
    }
}
