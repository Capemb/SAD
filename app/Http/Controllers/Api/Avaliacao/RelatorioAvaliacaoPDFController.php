<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <- se ainda não tiver, vamos instalar abaixo

class RelatorioAvaliacaoPDFController extends Controller
{
    public function __invoke(Request $request)
    {
        // Buscar todas as avaliações concluídas com seus relacionamentos
        $avaliacoes = Avaliacao::with(['avaliado', 'modulo'])
            ->where('status', 'concluida')
            ->get();

        // Calcular a média geral de notas
        $mediaGeral = $avaliacoes->avg('nota_final');

        // Gerar o PDF usando uma view
        $pdf = Pdf::loadView('pdf.relatorios.avaliacoes-geral', [
            'avaliacoes' => $avaliacoes,
            'mediaGeral' => $mediaGeral,
        ]);

        // Retornar o PDF para download
        return $pdf->download('relatorio-avaliacoes-geral.pdf');
    }
}

