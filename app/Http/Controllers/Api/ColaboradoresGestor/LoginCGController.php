<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class LoginCGController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validação básica
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'login' => ['Credenciais inválidas. Verifique o email e a senha.'],
            ]);
        }

        $token = $usuario->createToken('auth_token_usuario')->plainTextToken;

        // Retorna o usuário com role
        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'role' => $usuario->role, // colaborador ou gestor
            ]
        ], Response::HTTP_OK);
    }
}
