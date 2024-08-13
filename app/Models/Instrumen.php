<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrumen extends Model
{
    use HasFactory;
    protected $table = 'instrumen';

    protected $fillable=['nama_instrumen','butir_mutu'];

    public function standar(): HasMany 
    {
        return $this->hasMany(Standar::class, 'id_instrumen');
    }
    
}
