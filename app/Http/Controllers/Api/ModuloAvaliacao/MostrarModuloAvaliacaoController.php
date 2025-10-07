<?php

namespace App\Http\Controllers\Api\ModuloAvaliacao;

use App\Http\Controllers\Controller;
use App\Models\ModuloAvaliacao;

class MostrarModuloAvaliacaoController extends Controller
{
    public function __invoke($id)
    {
        //$modulo = ModuloAvaliacao::with('criterios')->findOrFail($id);

        //return response()->json($modulo);
    }
}
