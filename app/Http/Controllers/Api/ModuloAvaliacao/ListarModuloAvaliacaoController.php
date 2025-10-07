<?php

namespace App\Http\Controllers\Api\ModuloAvaliacao;

use App\Http\Controllers\Controller;
use App\Models\ModuloAvaliacao;
use Illuminate\Http\Request;

class ListarModuloAvaliacaoController extends Controller
{
    public function __invoke()
    {
        return response()->json(ModuloAvaliacao::all());
    }
}
