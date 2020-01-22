<?php namespace Visiosoft\ProfileModule\Profile\Validation;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\UsersModule\User\Authenticator\Contract\AuthenticatorExtensionInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;
use Visiosoft\ProfileModule\Profile\SignIn\SignInFormBuilder;


class ValidateCredentials
{
    public function __construct(
        ExtensionCollection $extensions,
        UserRepositoryInterface $userRepository,
        ProfileRepositoryInterface $profileRepository
    )
    {
        $this->extensions = $extensions;
        $this->repository = $userRepository;
        $this->profile = $profileRepository;
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
                    if ($profile = $this->profile->findPhoneNumber($credentials['email'])) {
                        if ($user = $this->repository->find($profile->user_id)) {
                            $credentials['email'] = $user->email;
                        }
                    }
                }
                $response = $this->repository->findByCredentials($credentials);

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
