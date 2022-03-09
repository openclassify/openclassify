<?php namespace Visiosoft\ProfileModule\Profile\Validator;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Visiosoft\ProfileModule\Profile\Validator\Contract\ValidatorExtensionInterface;

class ValidatorExtension extends Extension implements ValidatorExtensionInterface
{
    public function validate(array $fields)
    {
        return null;
    }
}
