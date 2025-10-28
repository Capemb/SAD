<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RelatorioColaboradorPDFController extends Controller
{
    public function __invoke($id)
    {
        $user = Auth::user();

        // 🔹 Busca apenas avaliações do colaborador autenticado
        $avaliacao = Avaliacao::with(['avaliado', 'avaliador', 'modulo', 'ciclo'])
            ->where('avaliado_id', $user->id)
            ->where('id', $id)
            ->first();

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada.'], 404);
        }

        // 🔹 Gera PDF
        $pdf = Pdf::loadView('pdf.relatorios.avaliacao_individual', compact('avaliacao'))
            ->setPaper('a4', 'portrait');

        // 🔹 Retorna PDF como download (stream binário)
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Relatorio_Avaliacao_'.$user->id.'.pdf"');
    }
}

