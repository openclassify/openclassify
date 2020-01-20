<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;

class ValidateRegister
{
    public function handle(FormBuilder $builder, ProfileRepositoryInterface $profileRepository, $attribute, $value)
    {
        if (!filter_var($builder->getPostValue('email'), FILTER_VALIDATE_EMAIL)) {
            if (!is_numeric($builder->getPostValue('email'))) {
                $builder->addFormError('email', trans('visiosoft.module.profile::message.error_valid_email_or_phone'));
                return false;
            } elseif (!is_null($profileRepository->findPhoneNumber($builder->getPostValue('email')))) {
                $builder->addFormError('email', trans('visiosoft.module.profile::message.registered_phone'));
                return false;
            }
        }
        return true;
    }
}
