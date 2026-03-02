<?php namespace Visiosoft\ProfileModule\Profile\Events;

use Anomaly\UsersModule\User\UserModel;

class SendEmptyPassword
{
    public $password;
    public $userId;

    public function __construct($userId, $password)
    {
        $this->password = $password;
        $this->userId = $userId;
    }

    public function user()
    {
        $user_model = new UserModel();
        $user = $user_model->find($this->userId);
        return $user;
    }

    public function password()
    {
        return $this->password;
    }
}