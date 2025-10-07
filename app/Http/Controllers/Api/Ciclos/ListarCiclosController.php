<?php

namespace App\Http\Controllers\Api\Ciclos;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;

class ListarCiclosController extends Controller
{
    public function __invoke()
    {
        $ciclos = Ciclo::orderBy('nome', 'desc')->get();
        return response()->json($ciclos);
    }
}

