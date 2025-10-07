<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EscolherPerfilController extends Controller
{
        /**
         * Handle the incoming request.
         */
        public function __invoke(Request $request)
        {
            $request->validate([
                'perfil_id' => 'required|exists:perfis,id',
            ]);

        $user = $request->user();
        if (!$user->perfis()->where('perfis.id', $request->perfil_id)->exists()) {
                return response()->json(['message' => 'Este perfil não está associado ao usuário.'], 403);
        }

        $user->perfil_ativo_id = $request->perfil_id;
        $user->save();

        return response()->json([
            'message' => 'Perfil ativo alterado com sucesso',
            'perfil_ativo' => $user->perfilAtivo,
        ]);
    }
}
