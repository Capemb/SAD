<?php

namespace App\Http\Controllers\Api\Ciclos;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;

class MostrarCicloController extends Controller
{
    public function __invoke($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return response()->json($ciclo);
    }
}
