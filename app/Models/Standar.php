<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Standar extends Model
{
    use HasFactory;
    protected $table = 'standar';
    public $timestamps = false;

    protected $fillable=['id_instrumen','nama',];

    public function ami():BelongsToMany
    {
        return $this->belongsToMany(Ami::class, 'ami_standar');
    }

    public function soal_standar(): HasMany 
    {
        return $this->hasMany(SoalStandar::class, 'id_standar');
    }

    public function instrumen(): BelongsTo 
    {
        return $this->belongsTo(Instrumen::class, 'id_instrumen');
    }

    public function tilik(): HasMany {
        return $this->hasMany(Tilik::class, 'id_standar');
    }

    public function rtp(): HasMany {
        return $this->hasMany(Rtp::class, 'id_standar');
    }
}

