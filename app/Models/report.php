<?php

namespace App\Models;

use App\Models\foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto_id',
        'deskripsi'
    ];
    protected $table = 'report';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function foto()
    {
        return $this->belongsTo(foto::class, 'foto_id', 'id');
    }
}
