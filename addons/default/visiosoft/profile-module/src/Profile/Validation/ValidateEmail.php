<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\ProfileModule\Profile\Password\ForgotPassFormBuilder;

class ValidateEmail
{
    public function handle(UserRepositoryInterface $users, $value, ForgotPassFormBuilder $builder)
    {
        //Is email or phone number
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $possiblePhone = $value;
            if (substr($value, 0, 1) == "+") {
                $possiblePhone = substr($value, 1);
            }
            if ($user = $users->newQuery()
                ->where('gsm_phone', 'LIKE', "%$possiblePhone")->first()) {
                $value = $user->email;
            }
        }

        if (!$response = $users->findByEmail($value)) {
            return false;
        }
        $builder->setUser($response);

        return true;
    }
}