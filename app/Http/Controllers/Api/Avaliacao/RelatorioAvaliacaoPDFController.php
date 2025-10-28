<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioAvaliacaoPDFController extends Controller
{
    /**
     * Gera e faz download do relatório geral em PDF
     */
    public function __invoke()
    {
        $avaliacoes = Avaliacao::with(['avaliado', 'avaliador', 'modulo', 'ciclo'])
            ->whereNotNull('nota_final')
            ->where('status', 'concluida')
            ->get(['id', 'avaliado_id', 'avaliador_id', 'modulo_id', 'ciclo_id', 'nota_final']);

        if ($avaliacoes->isEmpty()) {
            return response()->json([
                'message' => 'Nenhuma avaliação concluída encontrada.',
            ], 404);
        }

        $mediaGeral = round($avaliacoes->avg('nota_final'), 2);

        $pdf = Pdf::loadView('pdf.relatorios.avaliacoes', compact('avaliacoes', 'mediaGeral'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Relatorio_Geral_Avaliacoes.pdf');
    }
}
