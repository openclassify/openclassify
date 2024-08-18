<?php

return [
    'activate_your_account'   => [
        'subject'      => 'Activate Your Account',
        'greeting'     => 'Hello :display_name!',
        'instructions' => 'Thank you for registering! Please activate your account by clicking the button below.',
        'button'       => 'Activate Account',
    ],
    'user_pending_activation' => [
        'subject'      => 'User Pending Activation',
        'instructions' => ':username has just registered and is pending activation. To activate their account click the button below.',
        'button'       => 'Activate Account',
    ],
    'reset_your_password'     => [
        'subject'      => 'Reset Your Password',
        'greeting'     => 'Hello :display_name!',
        'notice'       => 'A password reset has been requested for your account.',
        'warning'      => 'If you did not make this request, you can safely ignore this email.',
        'instructions' => 'If you would actually like to reset your password click the button below.',
        'button'       => 'Reset Password',
    ],
    'password_invalidated'    => [
        'subject'      => 'Reset Your Password',
        'greeting'     => 'Hello :display_name!',
        'notice'       => 'A password reset has been requested for your account by an administrator.',
        'warning'      => 'Your current password is no longer valid.',
        'instructions' => 'Please click the button below to reset your password.',
        'button'       => 'Reset Password',
    ],
    'user_has_registered'     => [
        'subject'      => 'User Has Registered',
        'instructions' => ':username has just registered! To view their profile click the button below.',
        'button'       => 'View Profile',
    ],
    'user_has_been_activated' => [
        'subject'      => 'Account Activated',
        'greeting'     => 'Hello :display_name!',
        'instructions' => 'Your account has been activated.',
        'button'       => 'Login',
    ],
];
