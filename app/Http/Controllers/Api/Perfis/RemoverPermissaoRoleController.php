<?php

namespace App\Http\Controllers\Api\Perfis;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RemoverPermissaoRoleController extends Controller
{
    public function __invoke(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        return response()->json([
            'message' => 'Permissão removida com sucesso',
            'role' => $role->load('permissions')
        ]);
    }
}
