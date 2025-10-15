<?php

// App\Http\Controllers\Api\ColaboradoresGestor\LogoutCGController.php
namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutCGController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}

