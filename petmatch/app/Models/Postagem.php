<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postagem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'descricao', 'tipo_midia', 'url_midia', 'pet_id'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
