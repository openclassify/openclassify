<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

class ValidateRegister
{
    public function handle(FormBuilder $builder, UserRepositoryInterface $userRepository, $attribute, $value)
    {
        if (!is_numeric($builder->getPostValue('phone'))) {
            $builder->addFormError('phone', trans('visiosoft.module.profile::message.error_valid_phone'));
            return false;
        } elseif (!is_null($userRepository->newQuery()->where('gsm_phone', $builder->getPostValue('phone'))->first())) {
            $builder->addFormError('phone', trans('visiosoft.module.profile::message.registered_phone'));
            return false;
        }

        return true;
    }
}
