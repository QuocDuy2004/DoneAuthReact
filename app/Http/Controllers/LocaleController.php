<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
{
    $locale = $request->input('locale');
    $availableLocales = ['en', 'vi', 'th', 'fr', 'jp', 'kr', 'de', 'es', 'it'];

    if (in_array($locale, $availableLocales)) {
        session(['locale' => $locale]);
        App::setLocale($locale);

        if (Auth::check()) {
            $user = Auth::user();
            $user->lang = $locale;
            $user->save();
        }
    }

    return response()->json(['success' => true]);
}

}
