<?php

namespace App\Http\Controllers\Api\Perfis;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ListarPerfisController extends Controller
{
    public function __invoke()
    {
        $roles = Role::with('permissions')->get();
        return response()->json($roles);
    }
}






