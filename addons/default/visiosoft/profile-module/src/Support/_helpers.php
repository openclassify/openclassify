<?php

use Visiosoft\ProfileModule\Support\Command\getAdminUsers;

if (!function_exists('get_admins'))
{
	function get_admins() {
		return dispatch_sync(new getAdminUsers());
	}
}