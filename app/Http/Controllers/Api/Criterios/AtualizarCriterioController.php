<?php

namespace App\Http\Controllers\Api\Criterios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterio;

class AtualizarCriterioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,  Criterio $criterio)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'peso' => 'sometimes|numeric|min:0',
        ]);

        $criterio->update($data);
        return response()->json($criterio);
    }
}
