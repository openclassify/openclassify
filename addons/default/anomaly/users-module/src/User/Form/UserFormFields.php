<?php namespace Anomaly\UsersModule\User\Form;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModule\User\Validation\ValidatePassword;
use Anomaly\UsersModule\User\Validation\ValidateRoles;

/**
 * Class UserFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserFormFields
{

    /**
     * Handle the form fields.
     *
     * @param UserFormBuilder $builder
     */
    public function handle(UserFormBuilder $builder, UserModel $users, Authorizer $authorizer)
    {
        $fields = [
            'first_name',
            'last_name',
            'display_name',
            'username',
            'email',
            'password' => [
                'value'      => '',
                'required'   => false,
                'rules'      => [
                    'required_if:password,*',
                    'valid_password',
                ],
                'validators' => [
                    'valid_password' => [
                        'message' => false,
                        'handler' => ValidatePassword::class,
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'new-password',
                ],
            ],
            'activated',
            'enabled',
        ];

        // Only allow the user to see the roles if they are able to update permissions.
        // This avoids the risk of a user escalating themselves or another user to admin while still
        // giving them the ability to edit user info
        if ($authorizer->authorize('anomaly.module.users::users.manage_permissions')) {
            $fields['roles'] = [
                'rules' => [
                    'valid_roles',
                ],
                'validators' => [
                    'valid_roles' => [
                        'handler' => ValidateRoles::class,
                        'message' => 'anomaly.module.users::error.modify_admins',
                    ],
                ],
            ];
        }

        $assignments = $users->getAssignments();

        $builder->setFields(array_merge($fields, $assignments->notLocked()->fieldSlugs()));
    }
}
