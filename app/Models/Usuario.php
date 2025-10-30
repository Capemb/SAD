<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Model
{

    use HasApiTokens, Notifiable, HasFactory, HasRoles;
    protected $guard_name = 'api'; // Definindo o guard_name para o modelo Usuario

   protected $fillable = [
    'nome',
    'email',
    'telefone',
    'cargo',
    'departamento',
    'password',
    'role',
    'gestor_id'
];
 protected $hidden = [
        'password',
        'remember_token',
    ];

    // Se for colaborador → pertence a um gestor
    public function gestor()
    {
        return $this->belongsTo(Usuario::class, 'gestor_id');
    }

    // Se for gestor → tem vários colaboradores
    public function colaboradores()
    {
        return $this->hasMany(Usuario::class, 'gestor_id');
    }

    public function relatorios()
    {
        return $this->hasMany(Relatorio::class, 'gerado_por');
    }
}
