<?php namespace Anomaly\UsersModule\Role\Event;

use Anomaly\UsersModule\Role\Contract\RoleInterface;

/**
 * Class RoleWasDeleted
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RoleWasDeleted
{

    /**
     * The role object.
     *
     * @var RoleInterface
     */
    protected $role;

    /**
     * Create a new RoleWasDeleted instance.
     *
     * @param RoleInterface $role
     */
    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    /**
     * Get the role.
     *
     * @return RoleInterface
     */
    public function getRole()
    {
        return $this->role;
    }
}
