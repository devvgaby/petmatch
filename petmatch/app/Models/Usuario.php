<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',
        'endereco',
        'cep',
        'latitude',
        'longitude',
        'perfil_id'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function mensagensEnviadas()
    {
        return $this->hasMany(Mensagem::class, 'remetente_id');
    }

    public function mensagensRecebidas()
    {
        return $this->hasMany(Mensagem::class, 'destinatario_id');
    }

    // Verificacse o usuário é administrador
    public function isAdmin()
    {
        return $this->perfil && $this->perfil->nome === 'administrador';
    }

    // Verifica se o usuário é tutor
    public function isTutor()
    {
        return $this->perfil && $this->perfil->nome === 'tutor';
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
