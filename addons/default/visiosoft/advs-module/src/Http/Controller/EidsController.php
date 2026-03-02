<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EidsController extends PublicController
{
    public function eidsReturn(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        if ($request->durum === "Basarili") {
            $user->is_eids_verified = true;
            $user->eids_auth_code = $request->yetkiKodu;
            $user->save();
        }

        return $this->redirect->to(route('advs::create_adv'));
    }

}
