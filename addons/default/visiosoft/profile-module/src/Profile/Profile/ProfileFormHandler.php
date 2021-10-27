<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\ProfileModule\Events\UserUpdated;

class ProfileFormHandler
{
    protected $extensions;

    public function __construct(ExtensionCollection $extensions)
    {
        $this->extensions = $extensions;
    }

    public function handle(
        ProfileFormBuilder $builder,
        MessageBag $messages,
        UserModel $userModel
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $parameters = [
            'gsm_phone' => $builder->getPostValue('gsm_phone') ?: null,
            'office_phone' => $builder->getPostValue('office_phone') ?: null,
            'land_phone' => $builder->getPostValue('land_phone') ?: null,
            'identification_number' => $builder->getPostValue('identification_number') ?: null,
            'birthday' => $builder->getPostValue('birthday') ?: null,
            'register_type' => $builder->getPostValue('register_type') ?: null,
            'facebook_address' => $builder->getPostValue('facebook_address') ?: null,
            'google_address' => $builder->getPostValue('google_address') ?: null,
        ];

        $assignments = $userModel->getAssignments();
        foreach ($assignments->notLocked()->fieldSlugs() as $field) {
            $parameters[$field] = $builder->getPostValue($field) ?: null;
        }

        if (($valid = $this->validate($parameters)) !== true) {
            $messages->error($valid['msg']);
            return;
        }

        if (setting_value('visiosoft.module.profile::show_education_profession')) {
            $parameters = array_merge($parameters, [
                'education' => $builder->getPostValue('education'),
                'education_part' => $builder->getPostValue('education_part'),
                'profession' => $builder->getPostValue('profession'),
            ]);
        }

        $user = $userModel->newQuery()->find(\auth()->id());

        /**
         * Deprecated will bre removed after this issue is done #4804
         */
//        // Prevent removing already filled fields
//        foreach ($parameters as $field => $value) {
//            if ($user->$field && !$value) {
//                $messages->error('visiosoft.module.profile::message.can_not_remove_filled_fields');
//                return;
//            }
//        }

        $oldCustomerInfo = $user->toArray();

        $changes = $this->change($user, $parameters);

        event(new UserUpdated($oldCustomerInfo, $changes, $builder));

        $messages->success(trans('visiosoft.module.profile::message.success_update'));
    }

    public function change($user, $data)
    {
        $user->fill($data);
        $changes = $user->getDirty();
        $user->save();
        if (!count($changes)) {
            return false;
        }
        return $changes;
    }

    public function validate(array $fields)
    {
        $validators = $this->extensions
            ->search('visiosoft.module.profile::validation.*')
            ->enabled();

        foreach ($validators as $validator) {
            $valid = $validator->validate($fields);

            if (isset($valid['error']) && $valid['error']) {
                return $valid;
            }
        }

        return true;
    }
}
