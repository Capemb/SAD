<?php

namespace App\Http\Controllers\Api\AuthSpa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request()->noContent();
    }

    
}
