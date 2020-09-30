<?php

use Illuminate\Contracts\Bus\Dispatcher;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;

function fullLink($request, $url, $newParameters = array()) {
    return app(Dispatcher::class)->dispatch(new appendRequestURL($request, $url, $newParameters));
}