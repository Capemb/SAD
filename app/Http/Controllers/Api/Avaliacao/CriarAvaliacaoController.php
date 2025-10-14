<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;

class CriarAvaliacaoController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'avaliador_id' => 'required|exists:usuarios,id',
            'avaliado_id' => 'required|exists:usuarios,id',
            'modulo_id' => 'required|exists:modulos_avaliacao,id',
            'ciclo_id' => 'required|exists:ciclos_avaliacao,id',
            'comentarios' => 'nullable|string',
        ]);

        $avaliacao = Avaliacao::create([
            'avaliador_id' => $validated['avaliador_id'],
            'avaliado_id' => $validated['avaliado_id'],
            'modulo_id' => $validated['modulo_id'],
            'ciclo_id' => $validated['ciclo_id'],
            'data_avaliacao' => now(),
            'status' => 'em_progresso',
        ]);

        return response()->json([
            'message' => 'Avaliação criada com sucesso!',
            'avaliacao' => $avaliacao
        ], 201);
    }
}
