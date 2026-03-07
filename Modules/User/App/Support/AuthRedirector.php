<?php

namespace Modules\User\App\Support;

use Illuminate\Http\Request;

class AuthRedirector
{
    public function rememberQueryTarget(Request $request, string $key = 'redirect'): ?string
    {
        return $this->remember($request, $request->query($key));
    }

    public function rememberInputTarget(Request $request, string $key = 'redirect'): ?string
    {
        return $this->remember($request, $request->input($key));
    }

    public function sanitize(?string $target): ?string
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

    private function remember(Request $request, ?string $target): ?string
    {
        $sanitized = $this->sanitize($target);

        if ($sanitized !== null) {
            $request->session()->put('url.intended', $sanitized);
        }

        return $sanitized;
    }
}
