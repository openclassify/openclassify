<?php namespace Visiosoft\AdvsModule\Adv\Event;


class DeletingAd
{
    protected $entry;

    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    public function getEntry()
    {
        return $this->entry;
    }
}
