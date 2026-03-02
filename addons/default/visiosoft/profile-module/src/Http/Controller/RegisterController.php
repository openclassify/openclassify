<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Register\Command\HandleActivateRequest;
use Illuminate\Contracts\Encryption\Encrypter;
use Visiosoft\ProfileModule\Events\UserActivatedByMail;

class RegisterController extends PublicController
{
    private $encrypter;
    private $userRepository;

    public function __construct(Encrypter $encrypter, UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->encrypter = $encrypter;
        $this->userRepository = $userRepository;
    }

    public function activate()
    {
        if (!$this->dispatchSync(new HandleActivateRequest())) {

            $this->messages->error('anomaly.module.users::error.activate_user');

            return $this->redirect->to('/');
        }

        $user = $this->userRepository->findByEmail($this->encrypter->decrypt(request()->email));
        event(new UserActivatedByMail($user));

        $this->messages->success('anomaly.module.users::success.activate_user');
        $this->messages->success('anomaly.module.users::message.logged_in');

        return $this->redirect->to($this->request->get('redirect', '/'));
    }
}
