<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PerfisSeeder extends Seeder
{

        /**
        * Run the database seeds.
        */

    
    public function run(): void
    {
        DB::table('perfis')->insert([
            [
                'nome' => 'Avaliador',
                'descricao' => 'usuario que realiza avaliacoes de desempenho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Avaliado',
                'descricao' => 'usuario que e avaliado em seu desempenho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
