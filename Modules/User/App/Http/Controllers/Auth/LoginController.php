<?php

namespace Modules\User\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\User\App\Http\Requests\LoginRequest;
use Modules\User\App\Support\AuthProviderCatalog;
use Modules\User\App\Support\AuthRedirector;

class LoginController extends Controller
{
    public function __construct(
        private AuthProviderCatalog $providers,
        private AuthRedirector $redirector,
    ) {
    }

    public function create(Request $request): View
    {
        $redirectTo = $this->redirector->rememberQueryTarget($request);

        return view('user::auth.login', [
            'redirectTo' => $redirectTo,
            'socialProviders' => $this->providers->enabled('login', $redirectTo),
        ]);
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $this->redirector->rememberInputTarget($request);

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
}
