<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'eventos';
    protected $fillable = [
        'titulo',
        'descricao',
        'data_hora',
        'local',
        'latitude',
        'longitude',
        'max_participantes',
        'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
