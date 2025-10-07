<?php

namespace App\Http\Controllers\Api\RolePErmission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class AtribuirPermissaoUsuarioController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $request->validate([
            'permissions' => 'required|array'
        ]);

        foreach ($request->permissions as $permName) {
            $permission = Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'api']);
            $user->givePermissionTo($permission);
        }

        return response()->json([
            'message' => 'Permissões atribuídas ao usuário com sucesso',
            'user' => $user->load('permissions')
        ]);
    }
}
