<?php

namespace Modules\Demo\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Modules\Demo\App\Support\DemoSchemaManager;
use Modules\Demo\App\Support\TurnstileVerifier;
use Throwable;

class DemoController extends Controller
{
    public function prepare(
        Request $request,
        DemoSchemaManager $demoSchemaManager,
        TurnstileVerifier $turnstileVerifier,
    ): RedirectResponse
    {
        abort_unless(config('demo.enabled'), 404);

        $cookieName = (string) config('demo.cookie_name', 'oc2_demo');
        $redirectTo = $this->sanitizeRedirectTarget($request->input('redirect_to'))
            ?? route('home');

        if ($turnstileVerifier->enabled() && ! $turnstileVerifier->configured()) {
            return redirect()
                ->to($redirectTo)
                ->with('error', 'Security verification is unavailable right now. Please contact support.');
        }

        if (! $turnstileVerifier->verify(
            $request->input('cf-turnstile-response'),
            $request->ip(),
        )) {
            return redirect()
                ->to($redirectTo)
                ->with('error', 'Security verification failed. Please complete the check and try again.');
        }

        if (function_exists('set_time_limit')) {
            @set_time_limit(300);
        }

        if (function_exists('ignore_user_abort')) {
            @ignore_user_abort(true);
        }

        try {
            $instance = $demoSchemaManager->prepare($request->cookie($cookieName));
            $user = $demoSchemaManager->resolveLoginUser();

            Auth::guard('web')->login($user);
            $request->session()->regenerate();
            $request->session()->put([
                'demo_uuid' => $instance->uuid,
                'is_demo_session' => true,
                'demo_expires_at' => $instance->expires_at?->toIso8601String(),
            ]);

            Cookie::queue(cookie(
                $cookieName,
                $instance->uuid,
                (int) config('demo.ttl_minutes', 360),
            ));

            return redirect()->to($redirectTo)->with('success', 'Your private demo is ready.');
        } catch (Throwable $exception) {
            report($exception);

            Auth::guard('web')->logout();
            $request->session()->forget([
                'demo_uuid',
                'is_demo_session',
            ]);
            Cookie::queue(Cookie::forget($cookieName));
            $demoSchemaManager->activatePublic();

            return redirect()->to($redirectTo)->with('error', 'Demo could not be prepared right now.');
        }
    }

    private function sanitizeRedirectTarget(?string $target): ?string
    {
        $target = trim((string) $target);

        if ($target === '' || str_starts_with($target, '//')) {
            return null;
        }

        if (str_starts_with($target, '/')) {
            return $target;
        }

        if (! filter_var($target, FILTER_VALIDATE_URL)) {
            return null;
        }

        $applicationUrl = parse_url(url('/'));
        $targetUrl = parse_url($target);

        if (($applicationUrl['host'] ?? null) !== ($targetUrl['host'] ?? null)) {
            return null;
        }

        $path = $targetUrl['path'] ?? '/';
        $query = isset($targetUrl['query']) ? '?'.$targetUrl['query'] : '';
        $fragment = isset($targetUrl['fragment']) ? '#'.$targetUrl['fragment'] : '';

        return $path.$query.$fragment;
    }
}
