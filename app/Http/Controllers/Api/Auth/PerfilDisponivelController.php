<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perfil;


class PerfilDisponivelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       $usuario = $request->user();

        // Buscar os perfis que não estão associados ao usuário
        $perfisDisponiveis = Perfil::whereNotIn('id', $usuario->perfis()->pluck('perfis.id'))->get();

        return response()->json([
            'perfis_disponiveis' => $perfisDisponiveis
        ]);
    }
}
