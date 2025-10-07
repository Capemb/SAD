<?php

namespace App\Http\Controllers\Api\Criterios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterio;

class EliminarCriterioController extends Controller
{
    /**
     * Handle the incoming request.
     */

        public function __invoke(Criterio $criterio)
    {
        $criterio->delete();
        return response()->json(['message' => 'Critério removido com sucesso']);
    }

}
