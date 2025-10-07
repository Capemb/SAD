<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriosSeeder extends Seeder
{
    public function run(): void
    {
        // ID do módulo comportamental (1)
        DB::table('criterios')->insert([
            ['modulo_id' => 1, 'nome' => 'Comunicação',      'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 1, 'nome' => 'Trabalho em equipe','peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 1, 'nome' => 'Liderança',        'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 1, 'nome' => 'Ética',            'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ID do módulo técnico (2)
        DB::table('criterios')->insert([
            ['modulo_id' => 2, 'nome' => 'Conhecimento técnico', 'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 2, 'nome' => 'Produtividade',       'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 2, 'nome' => 'Qualidade',           'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['modulo_id' => 2, 'nome' => 'Resolução de problemas','peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ID do módulo metas (3)
        DB::table('criterios')->insert([
            ['modulo_id' => 3, 'nome' => 'Cumprimento de metas', 'peso' => 1.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
