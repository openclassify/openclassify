<?php namespace Visiosoft\ProfileModule\Profile\Events;

class SendForgotPasswordSms
{
    public $password;
    public $user;

    public function __construct($user, $password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }

    public function password()
    {
        return $this->password;
    }
}