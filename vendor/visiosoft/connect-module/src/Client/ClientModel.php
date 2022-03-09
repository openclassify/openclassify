<?php namespace Visiosoft\ConnectModule\Client;

use Laravel\Passport\Client;

class ClientModel extends Client
{

    public function getTitle()
    {
        return $this->name;
    }
}
