<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matches';

    protected $fillable = [
        'pet1_id',
        'pet2_id',
        'status'
    ];

    public function pet1()
    {
        return $this->belongsTo(Pet::class, 'pet1_id');
    }

    public function pet2()
    {
        return $this->belongsTo(Pet::class, 'pet2_id');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class, 'match_id');
    }
}
