<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{

    protected $table = 'perfis';
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
