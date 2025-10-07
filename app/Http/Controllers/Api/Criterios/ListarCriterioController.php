<?php

namespace App\Http\Controllers\Api\Criterios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterio;
use App\Models\ModuloAvaliacao;

class ListarCriterioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($modulo_id)
    {
        $modulo = ModuloAvaliacao::with('criterios')->findOrFail($modulo_id);
        return Response()->json($modulo->criterios);
    }
}
