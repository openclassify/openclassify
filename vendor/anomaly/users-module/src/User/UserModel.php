<?php

namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\User\Contract\RoleInterface;
use Anomaly\Streams\Platform\User\Contract\UserInterface as StreamsUser;
use Anomaly\UsersModule\Role\Command\GetRole;
use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\Role\RolePresenter;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

/**
 * Class UserModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UserModel extends UsersUsersEntryModel implements UserInterface, StreamsUser, \Illuminate\Contracts\Auth\Authenticatable
{

    use Notifiable;
    use Authenticatable;
    use CanResetPassword;

    /**
     * The eager loaded relationships.
     *
     * @var array
     */
    protected $with = [
        'roles',
    ];

    /**
     * The guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'password',
    ];

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get related roles.
     *
     * @return RoleCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Return whether a user is in a role.
     *
     * @param RoleInterface|RolePresenter|string $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (!is_object($role)) {
            $role = $this->dispatch(new GetRole($role));
        }

        if (!$role) {
            return false;
        }

        /* @var RoleInterface $role */
        foreach ($roles = $this->getRoles() as $attached) {
            if ($attached->getId() === $role->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return whether a user is in any of the provided roles.
     *
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        if (!$roles) {
            return false;
        }

        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return whether the user is an admin or not.
     *
     * @return bool
     */
    public function isAdmin()
    {
        /* @var RoleInterface $role */
        foreach ($this->getRoles() as $role) {
            if ($role->getSlug() === 'admin') {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the permissions.
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Return whether a user or it's roles has a permission.
     *
     * @param        $permission
     * @param  bool $checkRoles
     * @return mixed
     */
    public function hasPermission($permission, $checkRoles = true)
    {
        if (!$permission) {
            return true;
        }

        if (in_array($permission, $this->getPermissions())) {
            return true;
        }

        if ($checkRoles) {

            /* @var RoleInterface $role */
            foreach ($this->getRoles() as $role) {
                if ($role->hasPermission($permission) || $role->getSlug() === 'admin') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Return whether a user has any of provided permission.
     *
     * @param array $permissions
     * @param bool $checkRoles
     * @return bool
     */
    public function hasAnyPermission(array $permissions, $checkRoles = true)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission, $checkRoles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add permissions to the user.
     *
     * @param array $permissions
     * @return $this
     */
    public function addPermissions(array $permissions)
    {
        $this->permissions = array_merge($this->permissions, $permissions);

        return $this;
    }

    /**
     * Hash the password whenever setting it.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        array_set($this->attributes, 'password', app('hash')->make($password));
    }

    /**
     * Return whether the model is deletable or not.
     *
     * @return bool
     */
    public function isDeletable()
    {
        // You can't delete yourself.
        if ($this->getId() == app('auth')->id()) {
            return false;
        }

        // Only admins can delete admins
        if (!app('auth')->user()->isAdmin() && $this->isAdmin()) {
            return false;
        }

        return true;
    }

    /**
     * Return the activated flag.
     *
     * @return bool
     */
    public function isActivated()
    {
        return $this->activated;
    }

    /**
     * Return the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get the reset code.
     *
     * @return string
     */
    public function getResetCode()
    {
        return $this->reset_code;
    }

    /**
     * Get the activation code.
     *
     * @return string
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }

    /**
     * Return the full name.
     *
     * @return string
     */
    public function name()
    {
        return "{$this->getFirstName()} {$this->getLastName()}";
    }

    /**
     * Attach a role to the user.
     *
     * @param RoleInterface $role
     */
    public function attachRole(RoleInterface $role)
    {
        $this->roles()->attach($role);
    }

    /**
     * Detach a role from the user
     *
     * @param RoleInterface $role
     */
    public function detachRole(RoleInterface $role)
    {
        $this->roles()->detach($role);
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return env('SLACK_WEBHOOK');
    }

    /**
     * Return the model as a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = parent::toSearchableArray();

        array_pull($array, 'password');

        return $array;
    }

    /**
     * Return if the model should
     * be searchable or not.
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return $this->isActivated();
    }
}
