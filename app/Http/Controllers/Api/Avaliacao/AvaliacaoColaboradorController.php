<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Illuminate\Support\Facades\Auth;

class AvaliacaoColaboradorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $avaliacoes = Avaliacao::with(['avaliador', 'modulo', 'ciclo'])
            ->where('avaliado_id', $user->id)
            ->where('status', 'concluida')
            ->get(['id', 'nota_final', 'modulo_id', 'ciclo_id', 'avaliador_id']);

        return response()->json([
            'avaliacoes' => $avaliacoes
        ], 200);
    }
}
