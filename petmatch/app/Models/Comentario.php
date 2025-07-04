<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comentarios';
    protected $fillable = [
        'conteudo',
        'usuario_id',
        'postagem_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function postagem()
    {
        return $this->belongsTo(Postagem::class);
    }
}
