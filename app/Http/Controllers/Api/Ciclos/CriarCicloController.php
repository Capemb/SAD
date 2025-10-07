<?php

namespace App\Http\Controllers\Api\Ciclos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciclo;

class CriarCicloController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'inicio' => 'required|date',
            'fim' => 'required|date|after_or_equal:inicio',
        ]);

        $ciclo = Ciclo::create($data);

        return response()->json([
            'message' => 'Ciclo criado com sucesso!',
            'ciclo' => $ciclo
        ], 201);
    }
}
