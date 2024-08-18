<?php namespace Anomaly\UsersModule\User\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserPassword;

/**
 * Class ValidatePassword
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidatePassword
{

    /**
     * Handle the validation.
     *
     * @param FormBuilder  $builder
     * @param UserPassword $password
     * @param              $attribute
     * @param              $value
     * @return bool
     */
    public function handle(FormBuilder $builder, UserPassword $password, $attribute, $value)
    {
        $validator = $password->validate($value);

        foreach ($validator->errors()->all() as $error) {
            $builder->addFormError($attribute, $error);
        }

        return $validator->passes();
    }
}
