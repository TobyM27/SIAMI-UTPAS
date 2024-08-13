<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';


    protected $fillable=['id_ami','id_soalstandar','link','jawaban','keterangan','status_keterangan','komentar_keterangan'];

    public function soal_standar(): BelongsTo
    {
        return $this->belongsTo(SoalStandar::class, 'id_soalstandar');
    }

    public function ami(): BelongsTo 
    {
        return $this->belongsTo(Ami::class,'id_ami');
    }
}
