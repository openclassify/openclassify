<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(string $locale)
    {
        $available = config('app.available_locales', ['en']);
        if (in_array($locale, $available)) {
            session(['locale' => $locale]);
        }
        return redirect()->back()->withInput();
    }
}
