<?php

namespace App\Http\Controllers\Api\ColaboradoresGestor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class ListarCGController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->json(
            Usuario::with('gestor', 'colaboradores')->get()
        );
    }
}
