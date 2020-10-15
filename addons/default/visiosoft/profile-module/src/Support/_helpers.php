<?php

use Visiosoft\ProfileModule\Support\Command\getAdminUsers;

if (!function_exists('get_admins'))
{
	function getAdmins() {
		return dispatch_now(new getAdminUsers());
	}
}