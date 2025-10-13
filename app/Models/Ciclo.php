<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{

    protected $table = 'ciclos_avaliacao';
    protected $fillable = ['nome','inicio','fim', 'status'];

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
