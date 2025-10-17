<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Usuario;

class ListarAvaliacoesGestorController extends Controller
{
    public function __invoke(Request $request)
    {
        $gestor = $request->user();

        if (!$gestor) {
            return response()->json(['message' => 'Gestor não autenticado.'], 401);
        }

        // Buscar colaboradores da equipa deste gestor
        $colaboradoresIds = Usuario::where('gestor_id', $gestor->id)->pluck('id');

        // Buscar apenas avaliações criadas para o gestor e sua equipa
        $avaliacoes = Avaliacao::with(['avaliador', 'avaliado', 'modulo', 'ciclo'])
            ->where('avaliador_id', $gestor->id) // avaliador é o gestor
            ->orWhereIn('avaliado_id', $colaboradoresIds) // avaliados são os subordinados
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'avaliacoes' => $avaliacoes
        ]);
    }
}
