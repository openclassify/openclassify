<?php namespace Visiosoft\ConnectModule\Events;

class ActivateAccount
{
    protected $url;
    protected $user;

    public function __construct($user, $url)
    {
        $this->url = $url;
        $this->user = $user;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getUser()
    {
        return $this->user;
    }
}
