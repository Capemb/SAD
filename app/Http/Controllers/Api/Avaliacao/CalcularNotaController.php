<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\AvaliacaoCriterio;

class CalcularNotaController extends Controller
{
    public function __invoke($avaliacaoId)
    {
        $avaliacao = Avaliacao::with('criterios.criterio', 'modulo')->findOrFail($avaliacaoId);
        $criterios = $avaliacao->criterios;

        $soma = $criterios->sum('nota');
        $max = $criterios->count() * 5;

        $percentual = ($max > 0) ? ($soma / $max) * 100 : 0;
        $pesoModulo = $avaliacao->modulo->peso ?? 1;
        $notaFinal = $percentual * $pesoModulo;

        $avaliacao->update([
            'nota_final' => round($notaFinal, 2),
            'status' => 'concluida'
        ]);

        return response()->json([
            'avaliacao_id' => $avaliacao->id,
            'nota_final' => $avaliacao->nota_final,
            'percentual' => round($percentual, 2),
        ]);
    }
}

