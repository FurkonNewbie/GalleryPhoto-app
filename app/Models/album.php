<?php

namespace App\Models;

use App\Models\foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class album extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_album',
        'deskripsi'
    ];

    protected $table = 'album';

    public function foto()
    {
        return $this->hasMany(foto::class, 'album_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
