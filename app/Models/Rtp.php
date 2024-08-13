<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rtp extends Model
{
    use HasFactory;

    protected $table = 'rtp';

    protected $fillable=['id_ami','id_standar','temuan','rtp','penanggungjawab'];

    public function ami():BelongsTo
    {
        return $this->belongTo(Ami::class, 'id_ami');
    }

    public function standar():BelongsTo {
        return $this->belongsTo(Standar::class, 'id_standar');
    }

}
