<?php

use Illuminate\Contracts\Bus\Dispatcher;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;
use Visiosoft\AdvsModule\Support\Command\CheckModuleInstalled;
use Visiosoft\AdvsModule\Support\Command\GetBuyables;

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

if (!function_exists('get_buyables'))
{
	function get_buyables() {
		return dispatch_now(new GetBuyables());
	}
}