<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';


    protected $fillable=['id_ami','id_tilik','angka','catatan','kelebihan','kekurangan_kategori','peluang_peningkatan'];

    public function tilik(): BelongsTo
    {
        return $this->belongsTo(Tilik::class, 'id_tilik');
    }

    public function ami(): BelongsTo 
    {
        return $this->belongsTo(Ami::class, 'id_ami');
    }
}
