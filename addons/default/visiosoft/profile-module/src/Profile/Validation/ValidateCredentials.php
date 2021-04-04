<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\UsersModule\User\Authenticator\Contract\AuthenticatorExtensionInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Visiosoft\ProfileModule\Profile\Events\SendEmptyPassword;
use Visiosoft\ProfileModule\Profile\SignIn\SignInFormBuilder;

class ValidateCredentials
{
    private $extensions;
    private $repository;
    private $dispatcher;

    public function __construct(
        ExtensionCollection $extensions,
        UserRepositoryInterface $userRepository,
        Dispatcher $dispatcher
    )
    {
        $this->extensions = $extensions;
        $this->repository = $userRepository;
        $this->dispatcher = $dispatcher;
    }

    public function authenticate(array $credentials)
    {
        $authenticators = $this->extensions
            ->search('anomaly.module.users::authenticator.*')
            ->enabled();

        /* @var AuthenticatorExtensionInterface $authenticator */
        foreach ($authenticators as $authenticator) {
            if ($authenticator->slug == "default_authenticator") {
                if (!isset($credentials['password']) && !isset($credentials['email'])) {
                    $response = null;
                }

                //Is email or phone number
                if (!filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
                    $possiblePhone = $credentials['email'];
                    if (substr($credentials['email'], 0, 1) == 0) {
                        $possiblePhone = substr($credentials['email'], 1);
                    }
                    if ($user = $this->repository
                        ->newQuery()
                        ->where('gsm_phone', 'LIKE', "%$possiblePhone")->first()) {
                        $credentials['email'] = $user->email;
                    }
                }
                $response = $this->repository->findByCredentials($credentials);

                // Send new password if users password is empty
                if (is_null($response)) {
                    if (isset($credentials['email'])) {
                        $probableUser = $this->repository->findByEmail($credentials['email']);
                    } elseif (isset($credentials['username'])) {
                        $probableUser = $this->repository->findByUsername($credentials['username']);
                    }
                    if ($probableUser) {
                        if (is_null($probableUser->password) || empty($probableUser->password)) {
                            $password = $this->randomPassword();
                            $probableUser->setAttribute('password', $password);
                            $probableUser->update();
                            $this->dispatcher->dispatch(new SendEmptyPassword($probableUser->id, $password));
                        }
                    }
                }

            } else {
                $response = $authenticator->authenticate($credentials);
            }

            if ($response instanceof UserInterface) {
                return $response;
            }

            if ($response instanceof RedirectResponse) {
                return $response;
            }
        }

        return false;
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function handle(SignInFormBuilder $builder)
    {
        if (!$response = $this->authenticate($builder->getPostData())) {
            return false;
        }

        if ($response instanceof UserInterface) {
            $builder->setUser($response);
        }

        if ($response instanceof Response) {
            $builder->setFormResponse($response);
        }

        return true;
    }
}
