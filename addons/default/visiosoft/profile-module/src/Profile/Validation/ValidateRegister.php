<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;

class ValidateRegister
{
    public function handle(FormBuilder $builder, ProfileRepositoryInterface $profileRepository, $attribute, $value)
    {
        if (!is_numeric($builder->getPostValue('full_phone'))) {
            $builder->addFormError('full_phone', trans('visiosoft.module.profile::message.error_valid_phone'));
            return false;
        } elseif (!is_null($profileRepository->findPhoneNumber($builder->getPostValue('full_phone')))) {
            $builder->addFormError('full_phone', trans('visiosoft.module.profile::message.registered_phone'));
            return false;
        }
        return true;
    }
}
