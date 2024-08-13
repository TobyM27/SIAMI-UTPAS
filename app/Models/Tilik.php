<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tilik extends Model
{
    use HasFactory;
    protected $table = 'tilik';
    public $timestamps = false;

    protected $fillable=['id_standar','butir_mutu','pertanyaan'];

    public function standar(): BelongsTo 
    {
        return $this->belongsTo(Standar::class, 'id_standar');
    }

    public function penilaian():HasMany
    {
        return $this->HasMany(Penilaian::class, 'id_tilik');
    }
}
