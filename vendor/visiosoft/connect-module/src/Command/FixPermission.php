<?php namespace Visiosoft\ConnectModule\Command;

class FixPermission
{
    public function handle()
    {
        chmod(storage_path('streams/default/oauth-private.key'), 0600);
        chmod(storage_path('streams/default/oauth-public.key'), 0600);
    }
}
