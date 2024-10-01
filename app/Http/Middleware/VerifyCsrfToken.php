<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'api/auth/register',
        'api/auth/login',
        'api/auth/forgot-password',
        'api/auth/reset-password/*',
        'api/auth/logout',
        '/callback/telegram/v1'
    ];
}
