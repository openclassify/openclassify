<?php namespace Visiosoft\ProfileModule\Profile\Command;

use Anomaly\Streams\Platform\Support\Authorizer;

class Authorize
{
    protected $permission;

    public function __construct($permission)
    {
        $this->permission = $permission;
    }

    public function handle(Authorizer $authorizer)
    {
        return $authorizer->authorize($this->permission);
    }
}
