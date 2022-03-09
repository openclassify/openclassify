<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\UsersModule\User\Authenticator\Contract\AuthenticatorExtensionInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserWasLoggedIn;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Visiosoft\ProfileModule\Command\AuthAuto;
use Visiosoft\ProfileModule\Profile\ProfileRepository;

class UserAuthenticator
{
    use DispatchesJobs;

    protected $guard;
    protected $events;
    protected $container;
    protected $extensions;
    protected $settings;
    protected $advModel;

    public function __construct(
        Guard $guard,
        Dispatcher $events,
        Container $container,
        ExtensionCollection $extensions,
        AdvModel $advModel,
        SettingRepositoryInterface $settings)
    {
        $this->guard = $guard;
        $this->events = $events;
        $this->container = $container;
        $this->extensions = $extensions;
        $this->advModel = $advModel;
        $this->settings = $settings;
    }

    function valid_email($email)
    {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function attempt(Request $request, $remember = false, ProfileRepository $profileRepository)
    {
        $credentials = $request->toArray();
        if ($credentials) {
            unset($credentials['_token'], $credentials['remember_me']);
            if (!$this->valid_email($credentials['email'])) {
                $credentials['username'] = $credentials['email'];
                unset($credentials['email']);
                $validation = $profileRepository->validPasswordByUsername($credentials['username']);
            } else {
                $validation = $profileRepository->validPasswordByEmail($credentials['email']);
            }
            if ($validation == "noUser") {
                return Redirect::back()->with('error', [trans('visiosoft.module.profile::message.login_error')]);
            }
            if ($validation == "reset") {
                return Redirect::back()->with('info', [trans('visiosoft.module.profile::message.login_info_old_user')]);
            }
            if ($validation == "noMail") {
                return Redirect::back()->with('info', [trans('visiosoft.module.profile::message.login_noMail_old_user')
                    , trans('visiosoft.module.profile::message.login_noMail_old_user2'), trans('visiosoft.module.profile::message.login_noMail_old_user3')]);
            }
            if (isset($credentials['username'])) {
                $profile = $profileRepository->findProfileForLogin('gsm_phone', $credentials['username']);
                if ($profile != null) {
                    $find_user = $profileRepository->findUserForLogin('id', $profile->user_id);
                    $credentials['username'] = $find_user->username;
                }
            }
            if ($response = $this->authenticate($credentials)) {
                if ($response instanceof UserInterface) {
                    $this->login($response, $remember);
                    return Redirect::back();
                }
            }
        }
        return Redirect::back()->with('error', [trans('visiosoft.module.profile::message.login_error')]);
    }

    public function authenticate(array $credentials)
    {
        $authenticators = $this->extensions
            ->search('anomaly.module.users::authenticator.*')
            ->enabled();

        /* @var AuthenticatorExtensionInterface $authenticator */
        foreach ($authenticators as $authenticator) {

            $response = $authenticator->authenticate($credentials);

            if ($response instanceof UserInterface) {
                return $response;
            }

            if ($response instanceof RedirectResponse) {
                return $response;
            }
        }

        return false;
    }

    public function login(UserInterface $user, $remember = false)
    {
        $this->guard->login($user, $remember);

        $this->events->dispatch(new UserWasLoggedIn($user));
    }

    public function phoneValidation(Request $request, UserRepositoryInterface $userRepository)
    {
        $phoneNum = str_replace(' ', '', $request->phoneNumber);
        $userExists = $userRepository->findBy('gsm_phone', $phoneNum);
        if ($userExists) {
            return response()->json(['userExists' => true]);
        } else {
            return response()->json(['userExists' => false]);
        }
    }

    public function authAuto()
    {
        if (\request()->has(['token'])) {
            $this->dispatch(new AuthAuto(\request('token')));
        }
        return \redirect('/');
    }
}
