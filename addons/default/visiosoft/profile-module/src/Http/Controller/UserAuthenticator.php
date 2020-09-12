<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class UserAuthenticator
 *
 * @link   http://visiosoft.com.tr/
 * @author Visiosoft, Inc. <support@visiosoft.com.tr>
 * @author Vedat Akdoğan <vedat@visiosoft.com.tr>
 */
class UserAuthenticator
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function phoneValidation()
    {
        $phoneNum = str_replace(' ', '', request()->phoneNumber);
        $userExists = $this->userRepository->findBy('gsm_phone', $phoneNum);
        return $userExists ? ['userExists' => true] : ['userExists' => false];
    }
}
