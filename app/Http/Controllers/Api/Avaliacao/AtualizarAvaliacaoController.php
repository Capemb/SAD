<?php

namespace App\Http\Controllers\Api\Avaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;
use Illuminate\Support\Facades\Validator;

class AtualizarAvaliacaoController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'avaliador_id' => 'sometimes|exists:usuarios,id',
            'avaliado_id'  => 'sometimes|exists:usuarios,id',
            'modulo_id'    => 'sometimes|exists:modulos_avaliacao,id',
            'ciclo_id'     => 'nullable|exists:ciclos,id',
            'status'       => 'nullable|string|in:pendente,em_progresso,concluida',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $avaliacao->update($validator->validated());

        return response()->json([
            'message' => 'Avaliação atualizada com sucesso!',
            'avaliacao' => $avaliacao,
        ], 200);
    }
}
