<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    public function run()
    {
        // 🔹 Apaga dados antigos (se existirem) para não duplicar
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ------------------------
        // 📊 Permissões Gestor
        // ------------------------
        $gestorPermissions = [
            'ver_avaliacoes',
            'criar_avaliacoes',
            'atribuir_notas',
            'dar_feedback',
            'editar_avaliacoes',
            'fechar_avaliacoes',
            'ver_colaboradores',
            'atribuir_objetivos',
            'ver_objetivos',
            'ver_relatorios',
            'exportar_relatorios',
        ];

        // ------------------------
        // 👤 Permissões Colaborador
        // ------------------------
        $colaboradorPermissions = [
            'ver_minha_avaliacao',
            'autoavaliacao',
        ];

        // Criar permissões no sistema
        $allPermissions = array_merge($gestorPermissions, $colaboradorPermissions);
        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'api']);
        }

        // Criar roles
        $gestorRole = Role::firstOrCreate(['name' => 'gestor', 'guard_name' => 'api']);
        $colaboradorRole = Role::firstOrCreate(['name' => 'colaborador', 'guard_name' => 'api']);

        // Atribuir permissões ao Gestor
        $gestorRole->syncPermissions($gestorPermissions);

        // Atribuir permissões ao Colaborador
        $colaboradorRole->syncPermissions($colaboradorPermissions);

        $this->command->info('✅ Roles e permissões criados com sucesso!');
    }
}
