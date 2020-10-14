<?php

use Visiosoft\ProfileModule\Support\Command\getAdmins;

if (!function_exists('get_admins'))
{
	function getAdmins() {
		return dispatch_now(new getAdmins());
	}
}