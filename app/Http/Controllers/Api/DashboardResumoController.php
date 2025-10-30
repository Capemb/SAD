<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Usuario;
use App\Models\Relatorio;
use App\Models\Ciclo;
use Illuminate\Http\Request;

class DashboardResumoController extends Controller
{
    /**
     * Retorna resumo geral do dashboard (KPI, ciclos, relatórios)
     */
    public function __invoke(Request $request)
    {
        try {
            // KPIs principais
            $avaliacoesAtivas = Avaliacao::whereIn('status', ['concluida', 'em_andamento'])->count();
            $colaboradores = Usuario::where('role', 'colaborador')->count();

            // Percentual concluído
            $avaliacoesTotal = Avaliacao::count();
            $avaliacoesConcluidas = Avaliacao::where('status', 'concluida')->count();
            $percentualConcluido = $avaliacoesTotal > 0
                ? round(($avaliacoesConcluidas / $avaliacoesTotal) * 100, 1)
                : 0;

            $relatoriosGerados = Relatorio::count();

            // Últimos ciclos
            $ciclosRecentes = Ciclo::latest()->take(5)->get()->map(function ($c) {
                return [
                    'id' => $c->id,
                    'nome' => $c->nome,
                    'inicio' => $c->data_inicio,
                    'fim' => $c->data_fim,
                    'status' => $c->status,
                    'progress' => $c->progress ?? 0,
                ];
            });

            // Últimos relatórios
            $relatoriosRecentes = Relatorio::latest()->take(5)->get()->map(function ($r) {
                return [
                    'id' => $r->id,
                    'titulo' => $r->titulo ?? 'Relatório',
                    'created_at' => $r->created_at,
                ];
            });

            return response()->json([
                'kpis' => [
                    'avaliacoesAtivas' => $avaliacoesAtivas,
                    'colaboradores' => $colaboradores,
                    'percentualConcluido' => $percentualConcluido,
                    'relatoriosGerados' => $relatoriosGerados,
                ],
                'ciclosRecentes' => $ciclosRecentes,
                'relatoriosRecentes' => $relatoriosRecentes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao carregar resumo do dashboard',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
