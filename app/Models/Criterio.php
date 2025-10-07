<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criterio extends Model
{
    use HasFactory;

    protected $table = 'criterios';
    protected $fillable = ['modulo_id', 'nome', 'peso'];


    public function modulo()
    {
        return $this->belongsTo(ModuloAvaliacao::class, 'modulo_id');
    }


    public function avaliacoes()
    {
        return $this->belongsToMany(Avaliacao::class, 'avaliacao_criterios')
                    ->withPivot('nota');
    }


}
