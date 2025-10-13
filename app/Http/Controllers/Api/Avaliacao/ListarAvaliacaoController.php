<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;

class ListarAvaliacaoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $avaliacoes = Avaliacao::with(['avaliador', 'avaliado', 'ciclo', 'modulo', 'criterios'])->get();

        return response()->json([
            'avaliacoes' => $avaliacoes
        ]);


    }
}
