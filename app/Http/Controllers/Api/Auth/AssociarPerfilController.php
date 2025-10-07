<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssociarPerfilController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'perfil_id' => 'required|exists:perfis,id',
            ]);

            $user = $request->user();

            // Transação para garantir consistência
            DB::transaction(function () use ($user, $request) {

                // 1️⃣ Atualiza perfil ativo na tabela users
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['perfil_ativo_id' => $request->perfil_id]);

                // 2️⃣ Limpa todos os perfis antigos da pivot
                DB::table('usuario_perfis') // <-- ajuste o nome da tua tabela pivot
                    ->where('usuario_id', $user->id)
                    ->delete();

                // 3️⃣ Insere apenas o novo perfil
                DB::table('usuario_perfis') // <-- ajuste o nome da tua tabela pivot
                    ->insert([
                        'usuario_id' => $user->id,
                        'perfil_id' => $request->perfil_id,
                    ]);
            });

            return response()->json([
                'message' => 'Perfil atualizado com sucesso. O usuário agora possui apenas o perfil selecionado.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao atualizar perfil.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
