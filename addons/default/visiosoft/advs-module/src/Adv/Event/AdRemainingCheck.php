<?php namespace Visiosoft\AdvsModule\Adv\Event;

class AdRemainingCheck
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
