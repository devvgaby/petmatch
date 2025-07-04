<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mensagens';
    protected $fillable = [
        'remetente_id',
        'destinatario_id',
        'match_id',
        'conteudo',
        'lida_em'
    ];

    public function remetente()
    {
        return $this->belongsTo(Usuario::class, 'remetente_id');
    }

    public function destinatario()
    {
        return $this->belongsTo(Usuario::class, 'destinatario_id');
    }

    public function match()
    {
        return $this->belongsTo(PetMatch::class, 'match_id');
    }
}
