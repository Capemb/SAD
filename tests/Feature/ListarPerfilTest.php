<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Perfil;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListarPerfilTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usuario_autenticado_pode_listar_seus_perfis()
    {
        $user = User::factory()->create();
        $perfilAvaliador = Perfil::create([
            'nome' => 'Avaliador',
            'descricao' => 'usuario que realiza avaliacoes de desempenho',
        ]);


        $perfilAvaliado = Perfil::create([
            'nome' => 'Avaliado',
            'descricao' => 'usuario que e avaliado em seu desempenho',
        ]);

        //associar usaurio apenas a um perfil
        $user->perfis()->attach($perfilAvaliador->id);

        //act fazendo a requisicao
        $response = $this->actingAs($user)->getJson('/api/auth/perfis');

        //assert
        $response->assertStatus(200)
                 ->assertJsonCount(1, 'perfis') //verifica se retornou apenas um perfil
                 ->assertJsonFragment([
                     'nome' => 'Avaliador',
                    
                 ])
                 ->assertJsonMissing([
                     'nome' => 'Avaliado',
                      // esse não foi associado
                 ]);
    }

    /** @test */
    public function usuario_nao_autenticado_nao_pode_listar_perfis(){
        $response = $this->getJson('/api/auth/perfis');

        $response->assertStatus(401); // Unauthorized
    }
    
}
