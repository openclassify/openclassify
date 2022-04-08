<?php namespace Visiosoft\ConnectModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\ResourceController;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
use Anomaly\UsersModule\User\UserPassword;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Visiosoft\ConnectModule\Events\ActivateAccount;
use Visiosoft\ConnectModule\Events\ResetPassword;
use Visiosoft\ConnectModule\Events\UserRegistered;
use Visiosoft\ConnectModule\Notification\ResetYourPassword;


class ApiController extends ResourceController
{
    private $authenticator;
    private $guard;
    private $userRepository;

    public function __construct(
        UserAuthenticator $authenticator,
        UserRepositoryInterface $userRepository,
        Guard $guard
    )
    {
        $this->authenticator = $authenticator;
        $this->userRepository = $userRepository;
        $this->guard = $guard;
        parent::__construct();
    }

    public function login()
    {
        $request_parameters = $this->request->toArray();

        if (isset($request_parameters['email']) && !filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            $request_parameters['username'] = $request_parameters['email'];
            unset($request_parameters['email']);
        }

        if ($response = $this->authenticator->authenticate($request_parameters)) {
            if ($response instanceof UserInterface) {

                if (!$response->isActivated() or !$response->isEnabled()) {
                    return $this->response->json(['success' => false, 'message' => trans('visiosoft.module.connect::message.disabled_account')], 400);
                }

                $u_id = $response->id;
                $response = ['id' => $response->getId()];
                $response['token'] = app(\Visiosoft\ConnectModule\User\UserModel::class)->find($u_id)->createToken($u_id)->accessToken;

                return $this->response->json($response);
            }
        }

        return $this->response->json(['success' => false, 'message' => trans('visiosoft.module.connect::message.error_auth')], 400);
    }

    public function register()
    {
        $encrypter = app(Encrypter::class);
        $users = app(UserRepositoryInterface::class);

        // Forgot Request
        if (!$this->request->has('token')) {

            $validator = Validator::make(request()->all(), [
                'email' => 'required|email',
                'password' => 'required|max:55',
                'username' => 'required|max:20|unique:users_users,username',
                'name' => 'required|max:55',
                'callback' => 'required',
                'success-params' => 'required',
                'error-params' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            try {

                if (!$user = $users->findByEmail($this->request->email)) {

                    $create_parameters = [
                        'email' => $this->request->email,
                        'created_at' => Carbon::now(),
                        'str_id' => str_random(24),
                        'username' => $this->request->username,
                        'password' => app('hash')->make($this->request->password),
                        'display_name' => $this->request->name,
                        'first_name' => array_first(explode(' ', $this->request->name)),
                    ];

                    if ($this->request->has('referrer')) {
                        $create_parameters['referrer'] = $this->request->referrer;
                    }

                    $user_id = DB::table('users_users')->insertGetId($create_parameters);

                    $user = $this->userRepository->find($user_id);
                } else {
                    if ($user->enabled) {
                        $validator = Validator::make(request()->all(), [
                            'email' => 'required|email|unique:users_users,email',
                        ]);

                        if ($validator->fails()) {
                            return response()->json($validator->errors(), 400);
                        }
                    }
                }


                $user->setAttribute('activation_code', str_random(40));
                $user->save();

                $parameters['token'] = $encrypter->encrypt($user->getActivationCode());
                $parameters['success-verification'] = $encrypter->encrypt($this->request->get('success-params'));
                $parameters['error-verification'] = $encrypter->encrypt($this->request->get('error-params'));
                $parameters['redirect'] = $encrypter->encrypt($this->request->callback);
                $parameters['email'] = $encrypter->encrypt($user->email);

                $url = url('api/register') . '?' . http_build_query($parameters);

                event(new ActivateAccount($user, $url));
//                $user->notify(new ActivateYourAccount($url));

                return [
                    'success' => true,
                    'message' => trans('visiosoft.module.connect::message.pending_email_activation')
                ];

            } catch (\Exception $e) {
                return $this->response->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
        }

        $validator = Validator::make(request()->all(), [
            'success-verification' => 'required',
            'error-verification' => 'required',
            'token' => 'required',
            'redirect' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Redirect Request
        try {
            $activator = app(UserActivator::class);

            $callback = $encrypter->decrypt($this->request->redirect);

            $success = $encrypter->decrypt($this->request->get('success-verification'));
            $error = $encrypter->decrypt($this->request->get('error-verification'));


            if ($user = $users->findBy('email', $encrypter->decrypt($this->request->email))
                and $activator->activate($user, $encrypter->decrypt($this->request->token))) {

                $user->setAttribute('enabled', true);
                $user->save();

                event(new UserRegistered($user));

                $callback = $this->generateCallback($callback, ['code' => $this->request->token], $success);
            } else {

                $callback = $this->generateCallback($callback, [], $error);
            }

            return Redirect::to($callback);

        } catch (\Exception $e) {

            return $this->response->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function forgotPassword()
    {
        $users = app(UserRepositoryInterface::class);
        $encrypter = app(Encrypter::class);

        $parameters = array();

        // Forgot Request
        if (!$this->request->has('token')) {
            $validator = Validator::make(request()->all(), [
                'email' => 'required|email',
                'callback' => 'required',
                'success-params' => 'required',
                'error-params' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            try {
                $password = app(UserPassword::class);

                if (!$user = $users->findByEmail($this->request->email)) {
                    throw new \Exception(trans('anomaly.module.users::error.reset_password'));
                }

                $password->forgot($user);

                $parameters['token'] = $encrypter->encrypt($user->getResetCode());
                $parameters['success-verification'] = $encrypter->encrypt($this->request->get('success-params'));
                $parameters['error-verification'] = $encrypter->encrypt($this->request->get('error-params'));
                $parameters['redirect'] = $encrypter->encrypt($this->request->callback);
                $parameters['email'] = $encrypter->encrypt($user->email);

                $url = url('api/forgot-password') . '?' . http_build_query($parameters);

                event(new ResetPassword($user, $url));

                //$user->notify(new ResetYourPassword($url));

                return ['success' => true];

            } catch (\Exception $e) {
                return $this->response->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
        }

        $validator = Validator::make(request()->all(), [
            'success-verification' => 'required',
            'error-verification' => 'required',
            'token' => 'required',
            'redirect' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Redirect Request
        try {
            $callback = $encrypter->decrypt($this->request->redirect);

            $success = $encrypter->decrypt($this->request->get('success-verification'));
            $error = $encrypter->decrypt($this->request->get('error-verification'));

            if ($user = $users->findBy('email', $encrypter->decrypt($this->request->email))) {
                $callback = $this->generateCallback($callback, ['code' => $this->request->token], $success);
            } else {
                $callback = $this->generateCallback($callback, [], $error);
            }

            return Redirect::to($callback);

        } catch (\Exception $e) {

            return $this->response->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function renew()
    {
        $validator = Validator::make(request()->all(), [
            'code' => 'required',
            'password' => 'required|max:20',
            're-password' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (request('password') != request('re-password')) {
            throw new \Exception(trans('visiosoft.module.connect::message.error-re-password'));
            die;
        }

        $users = app(UserRepositoryInterface::class);
        $encrypter = app(Encrypter::class);
        $password = app(UserPassword::class);

        try {
            $code = $encrypter->decrypt($this->request->code);

            if (!$user = $users->findBy('reset_code', $encrypter->decrypt($this->request->code))) {
                throw new \Exception(trans('anomaly.module.users::error.reset_password'));
            }

            if (!$password->reset($user, $code, $this->request->get('password'))) {
                throw new \Exception(trans('anomaly.module.users::error.reset_password'));
            }

            return [
                'success' => true,
            ];

        } catch (\Exception $exception) {
            return $this->response->json(['success' => false, 'message' => $exception->getMessage()], 400);
        }
    }

    public function generateCallback($url, array $parameters, $string_parameters = '')
    {
        $url_parsed = parse_url($url);

        $parameters_prefix = "?";

        if (isset($url_parsed['query'])) {
            $parameters_prefix = "&";
        }

        return $url . $parameters_prefix . (count($parameters) ? http_build_query($parameters) . "&" . $string_parameters : "&" . $string_parameters);
    }
}
