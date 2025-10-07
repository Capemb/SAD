<?php

namespace App\Http\Controllers\Api\Ciclos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciclo;

class ActualizarStatusCicloController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:planejado,em_andamento,concluido'
        ]);

        $ciclo = Ciclo::findOrFail($id);
        $ciclo->status = $data['status'];
        $ciclo->save();

        return response()->json([
            'message' => 'Status atualizado com sucesso!',
            'ciclo' => $ciclo
        ]);
    }
}
