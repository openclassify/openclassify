<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\PartnerSocialRegistrationAvailability;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PartnerAuthGatewayController extends Controller
{
    public function login(): RedirectResponse
    {
        return redirect()->route('filament.partner.auth.login');
    }

    public function register(): RedirectResponse | Response
    {
        if (PartnerSocialRegistrationAvailability::isAvailable()) {
            return redirect()
                ->route('filament.partner.auth.login')
                ->with('success', __('Registration is available via social login providers.'));
        }

        return response()->view('auth.registration-disabled', status: Response::HTTP_FORBIDDEN);
    }
}
