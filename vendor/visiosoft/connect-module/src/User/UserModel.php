<?php namespace Visiosoft\ConnectModule\User;

use Laravel\Passport\HasApiTokens;

/**
 * Class UserModel
 *

 */
class UserModel extends \Anomaly\UsersModule\User\UserModel
{

    use HasApiTokens;
}
