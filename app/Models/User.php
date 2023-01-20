<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
        'email_verified_at',
        'description',
        'image',
        'location',
        'is_deactive',
        'deactivate_reason',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profession()
    {
        return $this->hasOne(UserProfession::class, 'user_id');
    }

    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class, 'user_id');
    }

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class, 'user_id');
    }

    public function userEducations()
    {
        return $this->hasMany(UserEducation::class, 'user_id');
    }

    public function userCertificates()
    {
        return $this->hasMany(UserCertificate::class, 'user_id');
    }

    public function gigs()
    {
        return $this->hasMany(UserGig::class, 'user_id');
    }
}
