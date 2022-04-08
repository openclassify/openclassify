<?php namespace Visiosoft\ConnectModule\Command;

use Anomaly\Streams\Platform\Support\Authorizer;

class CheckPermission
{

    protected $permission;

    public function __construct($permission)
    {
        $this->permission = $permission;
    }

    public function handle(Authorizer $authorizer)
    {
        if (!$authorizer->authorize($this->permission)) {
            throw new \Exception(trans('streams::message.access_denied'));
            die;
        }
    }
}