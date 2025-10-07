<?php

namespace App\Http\Controllers\Api\RolePermission;


use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class ListarTodasPermissoesController extends Controller
{
    public function __invoke()
    {
        $permissions = Permission::all();

        return response()->json($permissions);
    }
}
