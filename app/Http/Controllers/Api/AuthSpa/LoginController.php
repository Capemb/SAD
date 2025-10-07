<?php

namespace App\Http\Controllers\Api\AuthSpa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['O e-mail ou a senha estão incorretos.'],
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
        'message' => 'Login efetuado com sucesso',
        'user' => auth()->user(),
    ]);
    
    }
}

