<?php

namespace App\Http\Controllers\Api\ModuloAvaliacao;

use App\Http\Controllers\Controller;
use App\Models\ModuloAvaliacao;
use Illuminate\Http\Request;

class CriarModuloAvaliacaoController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'peso' => 'required|numeric|min:0|max:50',
            'ativo' => 'boolean',
        ]);

        $modulo = ModuloAvaliacao::create($validated);

        return response()->json([
            'message' => 'Módulo de avaliação criado com sucesso!',
            'modulo' => $modulo,
        ], 201);
    }
}
