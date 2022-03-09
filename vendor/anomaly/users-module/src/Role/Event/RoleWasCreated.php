<?php namespace Anomaly\UsersModule\Role\Event;

use Anomaly\UsersModule\Role\Contract\RoleInterface;

/**
 * Class RoleWasCreated
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RoleWasCreated
{

    /**
     * The role object.
     *
     * @var RoleInterface
     */
    protected $role;

    /**
     * Create a new RoleWasCreated instance.
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
