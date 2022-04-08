<?php namespace Visiosoft\ProfileModule\Events;

class UserUpdated
{
    public $oldCustomerInfo;
    public $changes;
    public $builder;

    public function __construct($oldCustomerInfo, $changes, $builder = null)
    {
        $this->oldCustomerInfo = $oldCustomerInfo;
        $this->changes = $changes;
        $this->builder = $builder;
    }
}