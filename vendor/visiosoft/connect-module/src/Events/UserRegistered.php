<?php namespace Visiosoft\ConnectModule\Events;

class UserRegistered
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
