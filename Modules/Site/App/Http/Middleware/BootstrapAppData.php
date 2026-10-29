<?php

declare(strict_types=1);

namespace Modules\Site\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Site\App\Support\RequestAppData;
use Symfony\Component\HttpFoundation\Response;

class BootstrapAppData
{
    public function __construct(private readonly RequestAppData $requestAppData) {}

    public function handle(Request $request, Closure $next): Response
    {
        $this->requestAppData->bootstrap();

        return $next($request);
    }
}
