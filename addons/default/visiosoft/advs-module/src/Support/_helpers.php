<?php

use Illuminate\Contracts\Bus\Dispatcher;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;
use Visiosoft\AdvsModule\Support\Command\GetBuyables;

if (!function_exists('fullLink'))
{
	function fullLink($request, $url, $newParameters = array()) {
		return app(Dispatcher::class)->dispatch(new appendRequestURL($request, $url, $newParameters));
	}
}

if (!function_exists('get_buyables'))
{
	function get_buyables() {
		return dispatch_sync(new GetBuyables());
	}
}

if (!function_exists('auth_id_if_null'))
{
	function auth_id_if_null($userId) {
		return $userId ?: auth()->id();
	}
}

if (!function_exists('replace_to_text'))
{
	function replace_to_text($content, $array)
	{
		foreach ($array as $key => $value) {
			$content = str_replace('${' . $key . '}', $value, $content);
		}

		return $content;
	}
}