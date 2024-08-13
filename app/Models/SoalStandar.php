<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SoalStandar extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'soal__standars';

    protected $fillable=['id_standar','butir_mutu', 'no_soal', 'daftar_pertanyaan'];

    public function dokumen():HasMany
    {
        return $this->hasMany(Dokumen::class, 'id_soalstandar');
    }

    public function tilik(): HasMany 
    {
        return $this->hasMany(Tilik::class, 'id_soalstandar');
    }

    public function standar(): BelongsTo 
    {
        return $this->belongsTo(Standar::class, 'id_standar');
    }
}
