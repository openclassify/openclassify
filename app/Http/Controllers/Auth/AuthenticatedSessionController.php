<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        $redirectTo = $this->sanitizeRedirectTarget(request()->query('redirect'));

        if ($redirectTo) {
            request()->session()->put('url.intended', $redirectTo);
        }

        return view('auth.login', [
            'redirectTo' => $redirectTo,
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $redirectTo = $this->sanitizeRedirectTarget($request->input('redirect'));

        if ($redirectTo) {
            $request->session()->put('url.intended', $redirectTo);
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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
        $query = isset($targetUrl['query']) ? '?' . $targetUrl['query'] : '';
        $fragment = isset($targetUrl['fragment']) ? '#' . $targetUrl['fragment'] : '';

        return $path . $query . $fragment;
    }
}
