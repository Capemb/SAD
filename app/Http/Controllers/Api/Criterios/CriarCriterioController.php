<?php

namespace App\Http\Controllers\Api\Criterios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterio;
use App\Models\ModuloAvaliacao;

class CriarCriterioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
      $data = $request->validate([
            'modulo_id' => 'required|exists:modulos_avaliacao,id',
            'nome' => 'required|string|max:255',
            'peso' => 'required|numeric|min:0',
        ]);

        $criterio = Criterio::create($data);
        return response()->json($criterio, 201);
    }
}
