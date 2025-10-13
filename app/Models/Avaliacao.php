<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;
    protected $table = 'avaliacoes';

    protected $fillable = [
        'avaliador_id',
        'avaliado_id',
        'ciclo_id',
        'modulo_id',
        'nota_final',
        'comentarios',
        'data_avaliacao',
        'relacao',
        'status'
    ];

    // Avaliador é um usuario (gestor ou colaborador)
    public function avaliador()
    {
        return $this->belongsTo(Usuario::class, 'avaliador_id');
    }

    // Avaliado também é um usuario
    public function avaliado()
    {
        return $this->belongsTo(Usuario::class, 'avaliado_id');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function modulo()
    {
        return $this->belongsTo(ModuloAvaliacao::class, 'modulo_id');
    }

   public function criterios()
    {
        return $this->belongsToMany(Criterio::class, 'avaliacao_criterios')
                    ->withPivot('nota');
    }
}
