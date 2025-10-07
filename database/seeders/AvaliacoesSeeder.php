<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvaliacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Avaliações podem ser inseridas aqui se necessário
        DB::table('avaliacoes')->insert([
            [
                'avaliador_id' => 1,
                'avaliado_id' => 2,
                'modulo_id' => 1,
                'data_avaliacao' => now(),
                'nota_final' => 4.5,
                'comentarios' => 'Ótimo desempenho geral.',
                'relacao' => 'gestor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'avaliador_id' => 2,
                'avaliado_id' => 3,
                'modulo_id' => 2,
                'nota_final' => 3.8,
                'data_avaliacao' => now(),
                'comentarios' => 'Bom conhecimento técnico, mas pode melhorar na comunicação.',
                'relacao' => 'par',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
