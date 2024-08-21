<?php namespace Visiosoft\RestateTheme\Profile\Form;

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
            'first_name' => $builder->getPostValue('first_name') ?: null,
            'last_name' => $builder->getPostValue('last_name') ?: null,
            'city' => $builder->getPostValue('city') ?: null,
            'district' => $builder->getPostValue('district') ?: null,
            'neighborhood' => $builder->getPostValue('neighborhood') ?: null,
            'gsm_phone' => $builder->getPostValue('gsm_phone') ?: null,
            'office_phone' => $builder->getPostValue('office_phone') ?: null,
            'land_phone' => $builder->getPostValue('land_phone') ?: null,
            'file_id' => $builder->getPostValue('file') ?: null,
        ];

        if (($valid = $this->validate($parameters)) !== true) {
            $messages->error($valid['msg']);
            return;
        }

        $user = $userModel->newQuery()->find(\auth()->id());

        // Prevent removing already filled fields
        foreach ($parameters as $field => $value) {
            if ($user->$field && !$value) {
                $messages->error('visiosoft.module.profile::message.can_not_remove_filled_fields');
                return;
            }
        }

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
