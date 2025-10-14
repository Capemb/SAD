<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // ⚡ Importante: evita redirecionar requisições API (JSON)
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

