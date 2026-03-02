<?php

use Visiosoft\GlobalHelperExtension\Support\Command\CheckInstalled;

if (!function_exists('is_module_installed'))
{
    function is_module_installed($slug, $type='module') {
        return dispatch_sync(new CheckInstalled($slug, $type));
    }
}

if (!function_exists('is_extension_installed'))
{
    function is_extension_installed($slug, $type='extension') {
        return dispatch_sync(new CheckInstalled($slug, $type));
    }
}