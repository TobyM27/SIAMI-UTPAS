<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RancanganAnggaran extends Model
{
    use HasFactory;

    protected $table = 'rancangan_anggaran';

    protected $fillable=['id_ami','nama_item','harga_satuan','jumlah_item','subtotal'];

    public function ami():BelongsTo
    {
        return $this->belongsTo(Ami::class, 'id_ami');
    }

}
