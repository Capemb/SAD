<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoCriterio extends Model
{
    protected $table = 'avaliacao_criterios';

    protected $fillable = [
        'avaliacao_id',
        'criterio_id',
        'nota',
        'comentarios'
    ];

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }

    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }
}
