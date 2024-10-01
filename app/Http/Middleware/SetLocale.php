<?php

// app/Http/Middleware/SetLocale.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $locale = Auth::user()->lang ?? 'vn'; // Default locale if user language is not set
            App::setLocale($locale);
        }

        return $next($request);
    }
}
