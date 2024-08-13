<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ami extends Model
{
    use HasFactory;
    protected $table = 'ami';

    protected $fillable=['id_user_auditor1', 'id_user_auditor2', 'id_user_auditee','id_user_lpm','prodi','siklus','tanggal_mulai','tanggal_ami','tanggal_akhir','nama_rektor_utpas' ,'nama_warek_utpas','nama_spmi', 'link_file', 'sah'];

    protected function casts(): array
{
    return [
        'tanggal_ami' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date'
    ];
}
    public function user_auditor1(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'id_user_auditor1');
    }
    public function user_auditor2(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'id_user_auditor2');
    }
    public function user_auditee(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'id_user_auditee');
    }
    public function user_lpm(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'id_user_lpm');
    }
    
    public function standar():BelongsToMany
    {
        return $this->belongsToMany(Standar::class, 'ami_standar', 'id_ami', 'id_standar');
    }

    public function dokumen():HasMany
    {
        return $this->hasMany(Dokumen::class, 'id_ami');
    }

    public function penilaian():HasMany
    {
        return $this->hasMany(Penilaian::class,'id_ami');
    }

    public function persetujuan():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'persetujuan_ami', 'id_user', 'id_ami');
    }

    public function rancangan_anggaran():HasMany
    {
        return $this->hasMany(RancanganAnggaran::class,'id_ami');
    }

    public function rtp():HasMany
    {
        return $this->hasMany(Rtp::class, 'id_ami');
    }

    public function lampiran():HasOne
    {
        return $this->hasOne(Lampiran::class, 'id_ami');
    }

    public function pengesahan():HasMany
    {
        return $this->hasMany(Pengesahan::class, 'id_ami');
    }

}
