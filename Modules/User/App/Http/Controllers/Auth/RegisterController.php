<?php

namespace Modules\User\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\User\App\Http\Requests\RegisterRequest;
use Modules\User\App\Models\User;
use Modules\User\App\Support\AuthProviderCatalog;
use Modules\User\App\Support\AuthRedirector;

class RegisterController extends Controller
{
    public function __construct(
        private AuthProviderCatalog $providers,
        private AuthRedirector $redirector,
    ) {
    }

    public function create(Request $request): View
    {
        $redirectTo = $this->redirector->rememberQueryTarget($request);

        return view('user::auth.register', [
            'redirectTo' => $redirectTo,
            'socialProviders' => $this->providers->enabled('register', $redirectTo),
        ]);
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->redirector->rememberInputTarget($request);

        $user = User::query()->create([
            'name' => $request->fullName(),
            'email' => $request->string('email')->toString(),
            'password' => $request->string('password')->toString(),
        ]);

        event(new Registered($user));

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
