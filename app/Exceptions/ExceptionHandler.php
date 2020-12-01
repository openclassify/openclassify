<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler;


class ExceptionHandler extends Handler
{

    public function report(Exception $e)
    {

        if (app()->bound('sentry') && $this->shouldReport($e)) {
            app('sentry')->captureException($e);
        }

        parent::report($e);
    }
}
