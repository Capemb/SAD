<?php

namespace App\Http\Controllers\Api\RolePErmission;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RemoverPermissaoUsuarioController extends Controller
{
    public function __invoke(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);

        return response()->json([
            'message' => 'Permissão removida do usuário com sucesso',
            'user' => $user->load('permissions')
        ]);
    }
}
