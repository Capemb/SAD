<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscolherPerfilTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuario_pode_escolher_um_perfil_que_possui()
    {
        // Arrange
        $user = User::factory()->create();
        $perfil = Perfil::create([
            'nome' => 'Avaliador',
            'descricao' => 'Perfil de avaliador',
        ]);

        // Vincular usuário ao perfil
        $user->perfis()->attach($perfil->id);

        // Simula usuário autenticado via sessão
        $this->actingAs($user);

        // Act
       $response = $this->postJson('/api/auth/perfis/escolher', [
    'perfil_id' => $perfil->id,
]);

        // Assert
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Perfil escolhido com sucesso.',
                     'perfil' => [
                         'id' => $perfil->id,
                         'nome' => 'Avaliador',
                     ],
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'perfil_ativo_id' => $perfil->id,
        ]);
    }

    /** @test */
    public function usuario_nao_pode_escolher_um_perfil_que_nao_possui()
    {
        $user = User::factory()->create();
        $perfil = Perfil::create([
            'nome' => 'Avaliado',
            'descricao' => 'Perfil de avaliado',
        ]);

        $this->actingAs($user);

            $response = $this->postJson('/api/auth/perfis/escolher', [
            'perfil_id' => $perfil->id,
        ]);

        $response->assertStatus(403)
                 ->assertJson([
                     'message' => 'Este perfil não está associado ao usuário.',
                 ]);
    }
}
