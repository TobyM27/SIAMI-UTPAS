<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'prodi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_auditor1(): HasMany 
    {
        return $this->hasMany(Ami::class, 'id_user_auditor1');
    }
    public function user_auditor2(): HasMany 
    {
        return $this->hasMany(Ami::class, 'id_user_auditor2');
    }
    public function user_auditee(): HasMany 
    {
        return $this->hasMany(Ami::class, 'id_user_auditee');
    }
    public function user_lpm(): HasMany 
    {
        return $this->hasMany(Ami::class, 'id_user_lpm');
    }

    public function pengesahan(): HasMany
    {
        return $this->hasMany(Pengesahan::class, 'id_user');
    }
}
