<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ModuloAvaliacaoTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_criar_modulo_avaliacao()
    {
        $response = $this->postJson('/api/modulos-avaliacao', [
            'nome' => 'Avaliacao 360',
            'descricao' => 'teste entre pares colegas e lider',
            'ativo' => true,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Módulo de avaliação criado com sucesso!',
                     'modulo' => [
                         'nome' => 'Avaliacao 360',
                         'descricao' => 'teste entre pares colegas e lider',
                         'ativo' => true,
                     ],
                 ]);


    }

  public function test_pode_listar_modulos_avaliacao()
    {
        $this->postJson('/api/modulos-avaliacao', [
            'nome' => 'Avaliacao 360',
            'descricao' => 'teste entre pares colegas e lider',
            'ativo' => true,
        ]);

        $response = $this->getJson('/api/modulos-avaliacao');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'nome' => 'Avaliacao 360',
                     'descricao' => 'teste entre pares colegas e lider',
                     'ativo' => true,
                 ]);
    }

  
}
