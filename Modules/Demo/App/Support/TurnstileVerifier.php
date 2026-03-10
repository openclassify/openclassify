<?php

namespace Modules\Demo\App\Support;

use Illuminate\Support\Facades\Http;
use Throwable;

final class TurnstileVerifier
{
    public function enabled(): bool
    {
        return (bool) config('demo.turnstile.enabled', false);
    }

    public function siteKey(): string
    {
        return trim((string) config('demo.turnstile.site_key', ''));
    }

    public function configured(): bool
    {
        return $this->siteKey() !== '' && $this->secretKey() !== '';
    }

    public function verify(?string $token, ?string $ip = null): bool
    {
        if (! $this->enabled()) {
            return true;
        }

        if (! $this->configured()) {
            return false;
        }

        $token = trim((string) $token);

        if ($token === '') {
            return false;
        }

        $payload = [
            'secret' => $this->secretKey(),
            'response' => $token,
        ];

        $ip = trim((string) $ip);

        if ($ip !== '') {
            $payload['remoteip'] = $ip;
        }

        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout(max(3, (int) config('demo.turnstile.timeout_seconds', 8)))
                ->post((string) config('demo.turnstile.verify_url'), $payload);

            if (! $response->ok()) {
                return false;
            }

            return (bool) data_get($response->json(), 'success', false);
        } catch (Throwable) {
            return false;
        }
    }

    private function secretKey(): string
    {
        return trim((string) config('demo.turnstile.secret_key', ''));
    }
}
