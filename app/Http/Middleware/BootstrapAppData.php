<?php

namespace App\Http\Middleware;

use App\Support\RequestAppData;
use Closure;
use Illuminate\Http\Request;

class BootstrapAppData
{
    public function __construct(private readonly RequestAppData $requestAppData)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $this->requestAppData->bootstrap();

        return $next($request);
    }
}
