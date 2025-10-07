<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
class ActualizarCGController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'telefone' => 'nullable|string',
            'cargo' => 'nullable|string',
            'departamento' => 'nullable|string',
            'role' => 'sometimes|in:gestor,colaborador',
            'gestor_id' => 'nullable|exists:usuarios,id'
        ]);
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return response()->json($usuario);
    }
}
