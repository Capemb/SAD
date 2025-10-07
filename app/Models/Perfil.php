<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Perfil extends Model
{
    protected $table = 'perfis';

    protected $fillable = ['nome'];

    public function perfis()
    {
        // Modelo relacionado, tabela pivot, chave estrangeira do User, chave estrangeira do Perfil
        return $this->belongsToMany(Perfil::class, 'usuario_perfis', 'usuario_id', 'perfil_id');
    }
}
