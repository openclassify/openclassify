<?php namespace Visiosoft\ConnectModule\Guard;

/**
 * Class RequestGuard
 *

 */
class RequestGuard extends \Illuminate\Auth\RequestGuard
{

    /**
     * Check if the user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        // @todo: Check permissions for guests.
        return parent::check();
    }
}
