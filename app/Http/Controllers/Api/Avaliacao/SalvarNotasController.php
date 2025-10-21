<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\AvaliacaoCriterio;
use Illuminate\Support\Facades\DB;

class SalvarNotasController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'avaliacao_id' => 'required|exists:avaliacoes,id',
            'notas' => 'required|array',
            'notas.*.criterio_id' => 'required|exists:criterios,id',
            'notas.*.nota' => 'required|numeric|min:1|max:5',
        ]);

        $avaliacao = Avaliacao::find($validated['avaliacao_id']);

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada.'], 404);
        }

        DB::transaction(function () use ($avaliacao, $validated) {
            foreach ($validated['notas'] as $n) {
                AvaliacaoCriterio::updateOrCreate(
                    [
                        'avaliacao_id' => $avaliacao->id,
                        'criterio_id' => $n['criterio_id'],
                    ],
                    ['nota' => $n['nota']]
                );
            }

            // 🔹 Calcula média final
            $total = AvaliacaoCriterio::where('avaliacao_id', $avaliacao->id)->sum('nota');
            $count = AvaliacaoCriterio::where('avaliacao_id', $avaliacao->id)->count();
            $media = $count > 0 ? ($total / ($count * 5)) * 100 : null;

            $avaliacao->update([
                'nota_final' => $media,
                'status' => 'concluida',
            ]);
        });

        return response()->json(['message' => 'Notas salvas com sucesso ✅']);
    }
}
