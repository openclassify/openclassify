<?php

namespace Modules\Site\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Site\App\Support\RequestAppData;

class BootstrapAppData
{
    public function __construct(private readonly RequestAppData $requestAppData) {}

    public function handle(Request $request, Closure $next): mixed
    {
        $this->requestAppData->bootstrap();

        return $next($request);
    }
}
