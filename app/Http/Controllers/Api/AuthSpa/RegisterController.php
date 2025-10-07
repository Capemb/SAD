<?php

namespace App\Http\Controllers\Api\AuthSpa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email') + [
            'password' => Hash::make($request->password)
        ]);

        Auth()->login($user);

        $request->session()->regenerate();
    }
}
