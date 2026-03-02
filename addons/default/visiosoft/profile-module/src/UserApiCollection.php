<?php namespace Visiosoft\ProfileModule;

use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\UsersModule\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class UserApiCollection extends UserRepository
{
    use DispatchesJobs;

    public function show(array $params)
    {
        $user = $this->newQuery()
            ->where('id', Auth::id())
            ->select([
                'first_name', 'last_name', 'email', 'gsm_phone',
                'office_phone', 'land_phone', 'identification_number',
                'birthday', 'facebook_address', 'google_address'
            ]);

        return $user;
    }

    public function edit(array $params)
    {
        $user = $this->newQuery()->find(Auth::id());

        $params = $this->removeUnsupportedParams($params);

        if (!empty($params['email'])) {
            if ($params['email'] != $user->email && $this->findBy('email', $params['email'])) {
                throw new \Exception(trans('visiosoft.module.profile::message.email_address_in_use'), 404);
            }
        }

        $user->update(array_merge([
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ], $params));

        return collect(['message' => trans('streams::message.edit_success', ['name' => 'Profile'])]);
    }

    public function removeUnsupportedParams($params)
    {
        $list = [
            'id', 'sort_order', 'created_at', 'created_by_id', 'updated_at', 'updated_by_id',
            'deleted_at', 'username', 'password', 'display_name', 'activated', 'enabled',
            'permissions', 'last_login_at', 'remember_token', 'activation_code', 'reset_code',
            'last_activity_at', 'ip_address', 'str_id', 'file_id', 'utm_source', 'utm_medium',
            'utm_campaign', 'utm_term', 'utm_content', 'browser_lang', 'location_for_ip', 'country_id',
            'city', 'district', 'neighborhood', 'village', 'register_type', 'notified_new_updates',
            'notified_about_ads', 'receive_messages_email', 'referrer'
        ];

        foreach ($list as $item) {
            if (in_array($item, array_keys($params))) {
                unset($params[$item]);
            }
        }

        return $params;
    }

    public function updateProfilePhoto()
    {
        if (!isset(request()->file('options')['parameters']['photo'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.required_parameter', ['parameter' => 'photo']));
            die;
        }

        $photo = request()->file('options')['parameters']['photo'];

        $uploader = app(FileUploader::class);

        $file = new UploadedFile($photo->getPathname(),
            strtotime("now") . '-' . str_replace(' ', '', $photo->getClientOriginalName()),
            $photo->getClientMimeType(),
            $photo->getError());

        $folders = app(FolderRepositoryInterface::class);

        if ($folder = $folders->findBySlug('images') and $file = $uploader->upload($file, $folder)) {
            $user = $this->newQuery()->find(Auth::id());

            $user->update([
                'updated_by_id' => Auth::id(),
                'updated_at' => Carbon::now(),
                'file_id' => $file->id
            ]);

            return collect(['message' => trans('streams::message.edit_success', ['name' => 'Profile photo'])]);
        }

        throw new \Exception(trans('visiosoft.module.profile::message.error'));
    }
}
