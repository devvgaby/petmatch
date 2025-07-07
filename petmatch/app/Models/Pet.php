<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pets';
    protected $fillable = [
        'nome',
        'especie',
        'raca',
        'idade',
        'sexo',
        'descricao',
        'preferencias',
        'foto_perfil_url',
        'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function postagens()
    {
        return $this->hasMany(Postagem::class);
    }

    public function matches1()
    {
        return $this->hasMany(PetMatch::class, 'pet1_id');
    }

    public function matches2()
    {
        return $this->hasMany(PetMatch::class, 'pet2_id');
    }

    public function getIdadeFormatadaAttribute()
    {
        $totalMeses = $this->idade; // idade em meses
        $anos = intdiv($totalMeses, 12);
        $meses = $totalMeses % 12;

        $texto = [];

        if ($anos > 0) {
            $texto[] = $anos . ' ' . ($anos === 1 ? 'ano' : 'anos');
        }
        if ($meses > 0) {
            $texto[] = $meses . ' ' . ($meses === 1 ? 'mês' : 'meses');
        }

        return count($texto) > 0 ? implode(' e ', $texto) : '0 mês';
    }

}
