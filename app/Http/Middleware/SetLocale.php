<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', config('app.locale'));
        $available = config('app.available_locales', ['en']);
        if (!in_array($locale, $available)) {
            $locale = config('app.locale');
        }
        app()->setLocale($locale);
        return $next($request);
    }
}
