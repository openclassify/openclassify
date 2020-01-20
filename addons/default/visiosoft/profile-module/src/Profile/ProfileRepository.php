<?php namespace Visiosoft\ProfileModule\Profile;

use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UsersModule\User\Password\Command\SendResetEmail;
use Anomaly\UsersModule\User\Password\Command\StartPasswordReset;
use Anomaly\UsersModule\User\Password\ForgotPasswordFormHandler;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModule\User\UserPassword;
use function CoffeeScript\t;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Visiosoft\ProfileModule\Http\Controller\MyProfileController;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ProfileRepository extends EntryRepository implements ProfileRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ProfileModel
     */
    protected $model;

    /**
     * Create a new ProfileRepository instance.
     *
     * @param ProfileModel $model
     */
    public function __construct(ProfileModel $model)
    {
        $this->model = $model;
    }

    public function getUser($id)
    {
        return UsersUsersEntryModel::query()->where('users_users.id', $id)->first();
    }

    public function getProfile($id)
    {
        return ProfileModel::query()->where('user_no_id', $id)->first();
    }

    public function findUserForLogin($field, $val)
    {
        $user = UserModel::query()->where($field, $val)->first();
        if ($user == null) {
            $profile = $this->findProfileForLogin('gsm_phone', $val);
            if ($profile != null) {
                $user = UserModel::query()->find($profile->user_no_id);
            }
        }
        return $user;
    }

    public function findProfileForLogin($field, $val)
    {
        return ProfileModel::query()->where($field, $val)->first();
    }

    public function validPasswordByEmail($email)
    {
        return $this->oldUserSendForgotMail($this->findUserForLogin('email', $email));
    }

    public function validPasswordByUsername($username)
    {
        return $this->oldUserSendForgotMail($this->findUserForLogin('username', $username));
    }

    public function oldUserSendForgotMail($user)
    {
        if ($user == null) {
            return "noUser";
        }
        if ($user->password == "alp236330" OR $user->password == "") {
            if ($user->email == "user2019" . $user->id . "@mail.com") {
                return "noMail";
            }
            $users = new UserPassword();
            $users->send($user, '/');
            return "reset";
        }
        return "yes";
    }

    public function updateUserField($fields)
    {
        $userModule = [];
        $userModule['display_name'] = $fields['first_name'] . " " . $fields['last_name'];
        $userModule['first_name'] = $fields['first_name'];
        $userModule['last_name'] = $fields['last_name'];
        //Core User Module
        UsersUsersEntryModel::query()->find(Auth::id())->update($userModule);
        foreach ($userModule as $key => $val) {
            unset($fields[$key]);
        }
        return $fields;

    }

    public function changePassword($fields, $userPassword)
    {
        if ($fields['new_password'] != $fields['re_new_password']) {
            $errorList[] = trans('anomaly.module.users::field.confirm_password.name');
            $fields['error'] = $errorList;
            return $fields;
        }

        $validator = $userPassword->validate($fields['new_password']);
        $errorList = array();
        foreach ($validator->errors()->all() as $error) {
            $errorList[] = $error;
        }
        if (count($errorList) != 0) {
            $fields['error'] = $errorList;
            return $fields;
        }

        UsersUsersEntryModel::query()->find(Auth::id())->update(['password' => Hash::make($fields['new_password'])]);
        unset($fields['new_password'], $fields['re_new_password'], $fields['confirm_password_input']);
        return $fields;
    }

    public function findByUserID($id)
    {
        return $this->model->where('user_no_id', $id)->first();
    }

    public function CheckPhoneNumber($phoneNumber)
    {
        return $this->model
            ->where('gsm_phone', $phoneNumber)
            ->where('user_no_id','!=', Auth::id())
            ->first();
    }

    public function findPhoneNumber($phone_number)
    {
        return $this->model->where('gsm_phone', $phone_number)
            ->first();
    }


}
