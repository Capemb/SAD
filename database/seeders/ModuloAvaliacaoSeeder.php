<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloAvaliacaoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('modulos_avaliacao')->insert([
            [
                'nome' => 'Competências Comportamentais',
                'descricao' => 'Avalia comunicação, liderança, trabalho em equipe e ética.',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Competências Técnicas',
                'descricao' => 'Avalia conhecimento técnico, produtividade, qualidade.',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Metas e Resultados',
                'descricao' => 'Avalia o atingimento de metas e indicadores de resultados.',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
