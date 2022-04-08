<?php namespace Anomaly\Streams\Platform\User\Contract;

/**
 * Interface RoleInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface RoleInterface
{


    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Return if the role has the
     * given permission or not.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission);
}
