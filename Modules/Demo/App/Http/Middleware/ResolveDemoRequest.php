<?php

namespace Modules\Demo\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Demo\App\Support\DemoSchemaManager;

class ResolveDemoRequest
{
    public function __construct(private readonly DemoSchemaManager $demoSchemaManager)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        if (! $this->demoSchemaManager->enabled()) {
            return $next($request);
        }

        $cookieName = (string) config('demo.cookie_name', 'oc2_demo');
        $demoUuid = $request->cookie($cookieName);
        $instance = $this->demoSchemaManager->findActiveInstance($demoUuid);
        $shouldForgetCookie = filled($demoUuid) && ! $instance;

        if (! $instance) {
            $this->resetDemoSession($request);
            $this->demoSchemaManager->activatePublic();

            $response = $next($request);

            if ($shouldForgetCookie) {
                Cookie::queue(Cookie::forget($cookieName));
            }

            return $response;
        }

        if (! (bool) $request->session()->get('is_demo_session') && $this->hasAuthSession($request)) {
            Auth::guard('web')->logout();
        }

        $this->demoSchemaManager->activateDemo($instance);

        $request->session()->put([
            'demo_uuid' => $instance->uuid,
            'is_demo_session' => true,
            'demo_expires_at' => $instance->expires_at?->toIso8601String(),
        ]);

        return $next($request);
    }

    private function resetDemoSession(Request $request): void
    {
        if (! $request->session()->has('demo_uuid') && ! (bool) $request->session()->get('is_demo_session')) {
            return;
        }

        if ($this->hasAuthSession($request)) {
            Auth::guard('web')->logout();
        }

        $request->session()->forget([
            'demo_uuid',
            'is_demo_session',
            'demo_expires_at',
        ]);
    }

    private function hasAuthSession(Request $request): bool
    {
        return filled($request->session()->get(Auth::guard('web')->getName()));
    }
}
