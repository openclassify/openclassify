<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleUsersCreateUsersStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleUsersCreateUsersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var string
     */
    protected $stream = [
        'slug'         => 'users',
        'title_column' => 'display_name',
        'trashable'    => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'email'        => [
            'required' => true,
            'unique'   => true,
        ],
        'username'     => [
            'required' => true,
            'unique'   => true,
        ],
        'password'     => [
            'required' => true,
        ],
        'roles'        => [
            'required' => true,
        ],
        'display_name' => [
            'required' => true,
        ],
        'first_name',
        'last_name',
        'activated',
        'enabled',
        'permissions',
        'last_login_at',
        'remember_token',
        'activation_code',
        'reset_code',
        'last_activity_at',
        'ip_address',
    ];

}
