<?php

namespace App\Http\Controllers\Api\Ciclos;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;

class ExcluirCicloController extends Controller
{
    public function __invoke($id)
    {
        $ciclo = Ciclo::findOrFail($id);

        if ($ciclo->status !== 'planejado') {
            return response()->json([
                'message' => 'Apenas ciclos planejados podem ser excluídos.'
            ], 422);
        }

        $ciclo->delete();

        return response()->json([
            'message' => 'Ciclo excluído com sucesso!'
        ]);
    }
}


