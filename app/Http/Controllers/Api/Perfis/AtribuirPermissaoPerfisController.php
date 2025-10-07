<?php

namespace App\Http\Controllers\Api\Perfis;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtribuirPermissaoPerfisController extends Controller
{
    public function __invoke(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $permissions = Permission::whereIn('name', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return response()->json([
            'message' => 'Permissões atribuídas com sucesso',
            'role' => $role->load('permissions')
        ]);
    }
}
