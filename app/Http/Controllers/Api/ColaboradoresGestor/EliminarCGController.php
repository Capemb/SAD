<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class EliminarCGController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuário eliminado com sucesso']);
    }
}
