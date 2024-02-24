<?php

namespace App\Models;

use App\Models\like;
use App\Models\User;
use App\Models\album;
use App\Models\comment;
use App\Models\favorit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'album_id',
        'report_id',
        'judul_foto',
        'deskripsi',
        'url'
    ];

    protected $table = 'foto';

    //relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function like()
    {
        return $this->hasMany(like::class, 'foto_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(comment::class, 'foto_id', 'id');
    }
    public function album()
    {
        return $this->belongsTo(album::class, 'album_id', 'id');
    }

    public function report()
    {
        return $this->hasOne(report::class, 'report_id', 'id');
    }
}
