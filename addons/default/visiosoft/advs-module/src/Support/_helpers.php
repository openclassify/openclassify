<?php

use Illuminate\Contracts\Bus\Dispatcher;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;
use Visiosoft\AdvsModule\Support\Command\CheckModuleInstalled;

if (!function_exists('fullLink'))
{
	function fullLink($request, $url, $newParameters = array()) {
		return app(Dispatcher::class)->dispatch(new appendRequestURL($request, $url, $newParameters));
	}
}

if (!function_exists('is_module_installed'))
{
	function is_module_installed($moduleNamespace, $checkEnabled = true) {
		return dispatch_now(new CheckModuleInstalled($moduleNamespace, $checkEnabled));
	}
}