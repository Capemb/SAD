<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class CriarCGController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
      $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'telefone' => 'nullable|string',
            'cargo' => 'nullable|string',
            'departamento' => 'nullable|string',
            'role' => 'required|in:gestor,colaborador',
            'password' => 'required|string|min:6',
            'gestor_id' => 'nullable|exists:usuarios,id'
        ]);

        $validated['password'] = Hash::make($validated ['password']);

        $usuario = Usuario::create($validated);

        return response()->json($usuario, 201);
    }
}
