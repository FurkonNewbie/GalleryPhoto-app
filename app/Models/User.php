<?php

namespace App\Models;

use App\Models\foto;
use App\Models\like;
use App\Models\album;
use App\Models\follow;
use App\Models\report;
use App\Models\comment;
use App\Models\favorit;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'no_telepon',
        'alamat',
        'bio',
        'profile',
        'role'
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


    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    public function foto()
    {
        return $this->hasMany(foto::class, 'user_id', 'id');
    }
    public function like()
    {
        return $this->hasOne(like::class, 'user_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(comment::class, 'user_id', 'id');
    }
    public function album()
    {
        return $this->hasMany(album::class, 'user_id', 'id');
    }
    public function follow()
    {
        return $this->hasMany(follow::class, 'user_id', 'id');
        return $this->belongsTo(follow::class, 'id', 'id');
    }

    public function report()
    {
        return $this->hasMany(report::class, 'user_id', 'id');
    }
}
