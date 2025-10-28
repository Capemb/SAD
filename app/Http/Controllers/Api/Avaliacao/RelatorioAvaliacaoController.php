<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;

class RelatorioAvaliacaoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // 🔹 Busca avaliações concluídas com nota_final
        $avaliacoes = Avaliacao::with(['avaliado', 'avaliador', 'modulo', 'ciclo'])
            ->whereNotNull('nota_final')
            ->where('status', 'concluida')
            ->get(['id', 'avaliado_id', 'avaliador_id', 'modulo_id', 'ciclo_id', 'nota_final']);

        if ($avaliacoes->isEmpty()) {
            return response()->json([
                'message' => 'Nenhuma avaliação concluída encontrada.',
                'avaliacoes' => [],
            ], 200);
        }

        return response()->json([
            'avaliacoes' => $avaliacoes,
        ], 200);
    }
}
