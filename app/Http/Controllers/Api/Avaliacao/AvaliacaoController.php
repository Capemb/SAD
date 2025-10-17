<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;


class AvaliacaoController extends Controller
{
    public function show($id)
{
    $avaliacao = Avaliacao::with(['avaliado', 'modulo.criterios'])
        ->findOrFail($id);

    return response()->json([
        'avaliacao' => $avaliacao,
        'criterios' => $avaliacao->modulo->criterios
    ]);
}

public function avaliar(Request $request, $id)
{
    $avaliacao = Avaliacao::findOrFail($id);

    foreach ($request->criterios as $criterio) {
        $avaliacao->criterios()->updateExistingPivot(
            $criterio['id'],
            ['nota' => $criterio['nota']]
        );
    }

    return response()->json(['message' => 'Avaliação salva com sucesso.']);
}

}
