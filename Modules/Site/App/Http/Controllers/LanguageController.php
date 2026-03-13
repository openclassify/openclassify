<?php

namespace Modules\Site\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        $available = config('app.available_locales', ['en']);

        if (in_array($locale, $available, true)) {
            session(['locale' => $locale]);
        }

        return redirect()->back()->withInput();
    }
}
