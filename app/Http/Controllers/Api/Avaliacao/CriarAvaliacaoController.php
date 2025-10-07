<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\AvaliacaoCriterio;

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
            'criterios' => 'required|array',
            'criterios.*.criterio_id' => 'required|exists:criterios,id', // ✅
            'criterios.*.nota' => 'required|integer|min:1|max:5',
        ]);

        $avaliacao = Avaliacao::create([
            'avaliador_id' => $validated['avaliador_id'],
            'avaliado_id' => $validated['avaliado_id'],
            'modulo_id' => $validated['modulo_id'],
            'ciclo_id' => $validated['ciclo_id'],
            'data_avaliacao' => now(), // ✅ atribui a data aqui!
            'comentarios' => $validated['comentarios'] ?? null,
            'status' => 'em_progresso',
        ]);

        foreach ($validated['criterios'] as $criterio) {
            AvaliacaoCriterio::create([
                'avaliacao_id' => $avaliacao->id,
                'criterio_id' => $criterio['criterio_id'],
                'nota' => $criterio['nota'],
            ]);
        }

        return response()->json([
            'message' => 'Avaliação criada com sucesso!',
            'avaliacao' => $avaliacao
        ], 201);

    }
}
