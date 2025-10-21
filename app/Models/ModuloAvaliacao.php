<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloAvaliacao extends Model
{
    protected $table = 'modulos_avaliacao';
    protected $fillable = ['nome', 'descricao', 'ativo','peso'];

    // Define relationships if necessary

    public function criterios()
    {
        return $this->hasMany(Criterio::class, 'modulo_id');
    }

}
