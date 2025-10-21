<?php

namespace App\Http\Controllers\Api\ModuloAvaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModuloAvaliacao;

class EliminarModuloAvaliacaoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $modulo = ModuloAvaliacao::find($id);

        if (!$modulo) {
            return response()->json([
                'message' => 'Módulo de avaliação não encontrado.'
            ], 404);
        }

        $modulo->delete();

        return response()->json([
            'message' => 'Módulo de avaliação eliminado com sucesso!'
        ], 200);
    }
}
