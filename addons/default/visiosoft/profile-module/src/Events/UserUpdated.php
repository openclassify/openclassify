<?php namespace Visiosoft\ProfileModule\Events;

class UserUpdated
{
    public $oldCustomerInfo;
    public $changes;

    public function __construct($oldCustomerInfo, $changes)
    {
        $this->oldCustomerInfo = $oldCustomerInfo;
        $this->changes = $changes;
    }
}