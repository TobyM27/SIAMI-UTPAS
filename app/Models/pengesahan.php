<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengesahan extends Model
{
    use HasFactory;

    protected $table = 'pengesahan';
    public $timestamps = false;

    protected $fillable=['id_ami','id_user','nama','jabatan','tanggal'];

    public function ami(): BelongsTo
    {
        return $this->belongsTo(Ami::class, 'id_ami');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
