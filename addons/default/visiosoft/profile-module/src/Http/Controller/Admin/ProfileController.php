<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UsersModule\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\ProfileModule\Profile\Form\ProfileFormBuilder;
use Visiosoft\ProfileModule\Profile\ProfileModel;
use Visiosoft\ProfileModule\Profile\Table\ProfileTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ProfileController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ProfileTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProfileTableBuilder $table)
    {
        $table->setColumns([
            'email' => [
                'value' => function (EntryModel $entry) {
                    $user = User::query()->find($entry->id);
                    if (!is_null($user))
                        return $user->email;
                }
            ],
            'gsm_phone'
        ]);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ProfileFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ProfileFormBuilder $form, $id)
    {
        $users = UsersUsersEntryModel::find($id);
        $profiles = ProfileModel::query()->where('user_id', $id)->orderBy("id")->first();
        if ($profiles == null) {
            $newProfile = [];
            $newProfile ['user_id'] = $id;
            $newProfile ['country_id'] = null;
            ProfileModel::query()->create($newProfile);
            $profiles = ProfileModel::query()->where('user_id', $id)->orderBy("id")->first();
        }
        $country = CountryModel::all();
        return $this->view->make('visiosoft.module.profile::admin.profile.edit', compact('users', 'profiles', 'country', 'form'));
    }

    public function update(ProfileFormBuilder $form, Request $request, $id)
    {
        $all = $request->all();
        if ($all['email'] == "" OR $all['username'] == "") {
            $error = [];
            if ($all['email'] == "") {
                $error[] = trans('visiosoft.module.profile::message.email');
            }
            if ($all['username'] == "") {
                $error[] = trans('visiosoft.module.profile::message.username');
            }
            return Redirect::back()->with('error', $error);
        }

        $userModule = [];
        $userModule['email'] = $all['email'];
        $userModule['username'] = $all['username'];
        $userModule['display_name'] = $all['display_name'];
        $userModule['first_name'] = $all['first_name'];
        $userModule['last_name'] = $all['last_name'];
        $userModule['activated'] = $all['activated'];
        $userModule['enabled'] = $all['enabled'];
        UsersUsersEntryModel::query()->find($id)->update($userModule);
        foreach ($userModule as $key => $val) {
            unset($all[$key]);
        }
        $all['file_id'] = $all['file'];
        unset($all['file']);
        unset($all['_token'], $all['action']);
        ProfileModel::query()->where('user_id', $id)->update($all);
        $message = [];
        $message[] = trans('visiosoft.module.profile::message.success_update');
        return redirect('admin/profile')->with('success', $message);
    }
}
