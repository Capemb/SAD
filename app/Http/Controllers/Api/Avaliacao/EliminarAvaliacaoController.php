<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Illuminate\Http\Request;

class EliminarAvaliacaoController extends Controller
{
    public function __invoke($id)
    {
        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada.'], 404);
        }

        $avaliacao->delete();

        return response()->json([
            'message' => 'Avaliação eliminada com sucesso!'
        ], 200);
    }
}

